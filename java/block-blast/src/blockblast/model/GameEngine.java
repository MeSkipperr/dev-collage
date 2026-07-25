package blockblast.model;

import java.util.ArrayList;
import java.util.List;
import java.util.Random;

/**
 * GameEngine.java
 * 
 * Central game logic controller for Block Blast.
 * Manages the game loop, turn-based block placement, scoring, combo detection,
 * and game-over conditions.
 * 
 * Responsibilities:
 * - Generate sets of 3 random blocks for each turn
 * - Track which blocks have been placed this turn
 * - Validate and execute block placement on the Board
 * - Calculate scores with combo multipliers
 * - Detect game-over state (no valid placement possible)
 * 
 * Design: Separates game logic from GUI (view) and user input (controller).
 * Uses the Board model for grid state and Block definitions for shapes.
 */
public class GameEngine {

    /** Score awarded per individual block cell cleared */
    public static final int POINTS_PER_CELL = 10;

    /** Combo multiplier: extra points per additional line cleared beyond the first */
    public static final int COMBO_MULTIPLIER = 50;

    /** Number of blocks given to the player each turn */
    public static final int BLOCKS_PER_TURN = 3;

    /** The game board — 8x8 grid */
    private final Board board;

    /** Random number generator for block selection */
    private final Random random;

    /** The 3 blocks currently available for this turn */
    private final List<Block> currentBlocks;

    /** The colors assigned to each current block */
    private final List<java.awt.Color> currentColors;

    /** Number of blocks placed so far this turn (0 to BLOCKS_PER_TURN) */
    private int blocksPlacedThisTurn;

    /** Current player score */
    private int score;

    /** Whether the game is over */
    private boolean gameOver;

    /** Total lines cleared across the entire game */
    private int totalLinesCleared;

    /** High score (persisted across games in this session) */
    private int highScore;

    /**
     * Predefined color palette for blocks.
     * Each block in a turn gets a different color for visual distinction.
     */
    private static final java.awt.Color[] BLOCK_COLORS = {
        new java.awt.Color(255, 87, 51),   // Coral/Red-Orange
        new java.awt.Color(52, 152, 219),  // Blue
        new java.awt.Color(46, 204, 113),  // Green
        new java.awt.Color(155, 89, 182),  // Purple
        new java.awt.Color(241, 196, 15),  // Yellow
        new java.awt.Color(230, 126, 34),  // Orange
        new java.awt.Color(26, 188, 156),  // Teal
        new java.awt.Color(231, 76, 60),   // Red
    };

    /**
     * Constructor: initializes the game engine with a new board.
     */
    public GameEngine() {
        this.board = new Board();           // Create the 8x8 grid
        this.random = new Random();         // Initialize RNG
        this.currentBlocks = new ArrayList<>();   // Initialize block list
        this.currentColors = new ArrayList<>();   // Initialize color list
        this.blocksPlacedThisTurn = 0;
        this.score = 0;
        this.gameOver = false;
        this.totalLinesCleared = 0;
        this.highScore = 0;
    }

    /**
     * Starts a new game by resetting all state and generating the first turn.
     */
    public void startNewGame() {
        board.clear();                      // Reset the grid to empty
        score = 0;                          // Reset score to 0
        gameOver = false;                   // Reset game-over flag
        totalLinesCleared = 0;              // Reset line counter
        blocksPlacedThisTurn = 0;           // Reset turn counter
        generateNewTurn();                  // Generate the first set of 3 blocks
    }

    /**
     * Generates a new set of 3 random blocks for the current turn.
     * Called at the start of each turn and after all 3 blocks are placed.
     */
    public void generateNewTurn() {
        // Clear previous turn's blocks
        currentBlocks.clear();
        currentColors.clear();
        blocksPlacedThisTurn = 0;

        // Get the full list of available block types
        List<Block> allBlocks = Block.getAllBlocks();

        // Select 3 random blocks (with possible duplicates)
        for (int i = 0; i < BLOCKS_PER_TURN; i++) {
            int index = random.nextInt(allBlocks.size()); // Random index
            currentBlocks.add(allBlocks.get(index));       // Add random block
            // Assign a color from the palette (cycle through if needed)
            currentColors.add(BLOCK_COLORS[i % BLOCK_COLORS.length]);
        }

        // Check if any block can be placed — if not, game over
        if (!canPlaceAnyBlock()) {
            gameOver = true;
        }
    }

    /**
     * Attempts to place a block from the current turn onto the board.
     * 
     * @param blockIndex the index of the block in currentBlocks (0, 1, or 2)
     * @param startRow   the grid row to place at
     * @param startCol   the grid column to place at
     * @return true if placement succeeded, false otherwise
     */
    public boolean placeBlock(int blockIndex, int startRow, int startCol) {
        // Validate block index
        if (blockIndex < 0 || blockIndex >= currentBlocks.size()) {
            return false;
        }

        // Check if all blocks this turn have been placed
        if (blocksPlacedThisTurn >= BLOCKS_PER_TURN) {
            return false;
        }

        Block block = currentBlocks.get(blockIndex);
        java.awt.Color color = currentColors.get(blockIndex);

        // Validate placement using the board
        if (!board.canPlace(block, startRow, startCol)) {
            return false; // Cannot place here
        }

        // Execute placement on the board
        boolean placed = board.placeBlock(block, startRow, startCol, color);

        if (placed) {
            // Mark this block as placed
            blocksPlacedThisTurn++;

            // Calculate score for this placement
            int cellsCleared = block.getCellCount();
            int linesCleared = board.clearFullLines();

            // Score calculation: cells cleared + combo bonus
            int turnScore = cellsCleared * POINTS_PER_CELL;

            // Combo bonus: if more than 1 line cleared, add multiplier per extra line
            if (linesCleared > 1) {
                turnScore += (linesCleared - 1) * COMBO_MULTIPLIER * linesCleared;
            }

            score += turnScore;
            totalLinesCleared += linesCleared;

            // Update high score if current score exceeds it
            if (score > highScore) {
                highScore = score;
            }

            // If all 3 blocks placed, generate new turn
            if (blocksPlacedThisTurn >= BLOCKS_PER_TURN) {
                generateNewTurn();
            } else {
                // Check if remaining blocks can still be placed
                if (!canPlaceAnyRemainingBlock()) {
                    // No valid moves for remaining blocks — game over
                    gameOver = true;
                }
            }
        }

        return placed;
    }

    /**
     * Checks if ANY of the 3 current blocks can be placed somewhere on the board.
     * Used for game-over detection at the start of a new turn.
     * 
     * @return true if at least one block can be placed, false otherwise
     */
    private boolean canPlaceAnyBlock() {
        // Iterate over each of the 3 current blocks
        for (int b = 0; b < currentBlocks.size(); b++) {
            Block block = currentBlocks.get(b);
            // For each block, try every possible position on the 8x8 grid
            for (int row = 0; row < Board.ROWS; row++) {
                for (int col = 0; col < Board.COLS; col++) {
                    if (board.canPlace(block, row, col)) {
                        return true; // Found at least one valid placement
                    }
                }
            }
        }
        return false; // No valid placement found for any block
    }

    /**
     * Checks if any of the REMAINING (unplaced) blocks can be placed.
     * Used for game-over detection after placing some blocks this turn.
     * 
     * @return true if at least one remaining block can be placed
     */
    private boolean canPlaceAnyRemainingBlock() {
        // Iterate over unplaced blocks only
        for (int b = blocksPlacedThisTurn; b < currentBlocks.size(); b++) {
            Block block = currentBlocks.get(b);
            // Try every possible position on the grid
            for (int row = 0; row < Board.ROWS; row++) {
                for (int col = 0; col < Board.COLS; col++) {
                    if (board.canPlace(block, row, col)) {
                        return true; // Found a valid placement
                    }
                }
            }
        }
        return false; // No valid placement for remaining blocks
    }

    // ========================================================================
    // GETTERS — Accessor methods for game state (Encapsulation)
    // ========================================================================

    /** Returns the game board instance */
    public Board getBoard() { return board; }

    /** Returns the list of blocks available this turn */
    public List<Block> getCurrentBlocks() { return currentBlocks; }

    /** Returns the colors for the current turn's blocks */
    public List<java.awt.Color> getCurrentColors() { return currentColors; }

    /** Returns the number of blocks placed this turn */
    public int getBlocksPlacedThisTurn() { return blocksPlacedThisTurn; }

    /** Returns the remaining blocks to place this turn */
    public int getRemainingBlocks() { return BLOCKS_PER_TURN - blocksPlacedThisTurn; }

    /** Returns the current player score */
    public int getScore() { return score; }

    /** Returns whether the game is over */
    public boolean isGameOver() { return gameOver; }

    /** Returns total lines cleared across the game */
    public int getTotalLinesCleared() { return totalLinesCleared; }

    /** Returns the high score */
    public int getHighScore() { return highScore; }

    /**
     * Previews where a block would be placed (for ghost/highlight effect).
     * Returns true if the block can be placed at the given position.
     * 
     * @param blockIndex index of the block in currentBlocks
     * @param startRow   grid row
     * @param startCol   grid column
     * @return true if the placement is valid
     */
    public boolean canPlaceAt(int blockIndex, int startRow, int startCol) {
        if (blockIndex < 0 || blockIndex >= currentBlocks.size()) {
            return false;
        }
        Block block = currentBlocks.get(blockIndex);
        return board.canPlace(block, startRow, startCol);
    }
}
