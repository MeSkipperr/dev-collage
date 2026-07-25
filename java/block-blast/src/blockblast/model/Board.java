package blockblast.model;

import java.util.ArrayList;
import java.util.List;

/**
 * Board.java
 * 
 * Represents the core 8x8 game grid for Block Blast.
 * Encapsulates all grid state management, cell occupancy tracking,
 * row/column validation, and simultaneous line-clearing logic.
 * 
 * Responsibilities:
 * - Maintain a 2D boolean array representing cell occupancy
 * - Provide methods to place and query block positions
 * - Detect and clear fully filled rows AND columns simultaneously
 * - Return the count of cleared lines for scoring
 * 
 * Design: Uses a boolean grid where true = occupied, false = empty.
 * Blocks are represented externally as coordinate pairs that map onto this grid.
 */

/**
 * Board class: manages the 8x8 grid state for Block Blast.
 * Handles cell occupancy, placement validation, and simultaneous row/column clearing.
 * Uses encapsulation — grid is private, accessed only through public methods.
 */
public class Board {

    /** Number of rows in the grid */
    public static final int ROWS = 8;

    /** Number of columns in the grid */
    public static final int COLS = 8;

    /**
     * 2D boolean array representing the grid.
     * grid[row][col] == true means the cell is occupied by a block.
     * Encapsulated: private access, modified only through public methods.
     */
    private final boolean[][] grid;

    /**
     * 2D Color array tracking the color of each placed block for rendering.
     * gridColor[row][col] stores the Color assigned when a block is placed.
     */
    private final java.awt.Color[][] gridColor;

    /**
     * Constructor: initializes an empty 8x8 board.
     * All cells set to false (unoccupied) by default.
     */
    public Board() {
        // Allocate the 2D array for occupancy tracking
        this.grid = new boolean[ROWS][COLS];
        // Allocate the 2D array for color tracking (used by the view layer)
        this.gridColor = new java.awt.Color[ROWS][COLS];
    }

    /**
     * Checks if a specific cell is occupied.
     * 
     * @param row the row index (0-based)
     * @param col the column index (0-based)
     * @return true if the cell is occupied, false otherwise
     */
    public boolean isOccupied(int row, int col) {
        // Boundary check to prevent ArrayIndexOutOfBoundsException
        if (row < 0 || row >= ROWS || col < 0 || col >= COLS) {
            return true; // Out-of-bounds treated as occupied (impassable)
        }
        return grid[row][col];
    }

    /**
     * Returns the color of the block at a specific cell.
     * 
     * @param row the row index
     * @param col the column index
     * @return the Color of the block, or null if cell is empty
     */
    public java.awt.Color getCellColor(int row, int col) {
        if (row < 0 || row >= ROWS || col < 0 || col >= COLS) {
            return null;
        }
        return gridColor[row][col];
    }

    /**
     * Attempts to place a block onto the board at the specified grid position.
     * 
     * Pre-conditions (must be checked BEFORE calling):
     * - The block shape must fit entirely within the grid bounds
     * - No cell in the block's footprint is already occupied
     * 
     * @param block the Block to place
     * @param startRow the top-left row position on the grid
     * @param startCol the top-left column position on the grid
     * @param color the color to assign to the placed cells
     * @return true if placement succeeded, false if any cell is occupied or out of bounds
     */
    public boolean placeBlock(blockblast.model.Block block, int startRow, int startCol, java.awt.Color color) {
        // First, validate that all cells are free
        // Nested loop iterates over the block's shape matrix
        for (int r = 0; r < block.getRows(); r++) {
            for (int c = 0; c < block.getCols(); c++) {
                // Only process filled cells in the block shape
                if (block.isFilled(r, c)) {
                    int gridRow = startRow + r; // Map block-local row to grid row
                    int gridCol = startCol + c; // Map block-local col to grid col

                    // Check bounds
                    if (gridRow < 0 || gridRow >= ROWS || gridCol < 0 || gridCol >= COLS) {
                        return false; // Out of bounds — cannot place
                    }
                    // Check occupancy
                    if (grid[gridRow][gridCol]) {
                        return false; // Cell already occupied — cannot place
                    }
                }
            }
        }

        // All cells are free — commit the placement
        // Second nested loop marks cells as occupied and assigns color
        for (int r = 0; r < block.getRows(); r++) {
            for (int c = 0; c < block.getCols(); c++) {
                if (block.isFilled(r, c)) {
                    int gridRow = startRow + r;
                    int gridCol = startCol + c;
                    grid[gridRow][gridCol] = true;          // Mark cell as occupied
                    gridColor[gridRow][gridCol] = color;     // Store the block color
                }
            }
        }
        return true; // Placement successful
    }

    /**
     * Checks if a block can be placed at the specified position without overlapping.
     * Does NOT modify the board — read-only validation.
     * 
     * @param block the Block to test
     * @param startRow the top-left row position
     * @param startCol the top-left column position
     * @return true if the block fits entirely within bounds and on empty cells
     */
    public boolean canPlace(blockblast.model.Block block, int startRow, int startCol) {
        // Iterate over the block's shape matrix
        for (int r = 0; r < block.getRows(); r++) {
            for (int c = 0; c < block.getCols(); c++) {
                if (block.isFilled(r, c)) {
                    int gridRow = startRow + r;
                    int gridCol = startCol + c;

                    // Check boundaries
                    if (gridRow < 0 || gridRow >= ROWS || gridCol < 0 || gridCol >= COLS) {
                        return false;
                    }
                    // Check if cell is already occupied
                    if (grid[gridRow][gridCol]) {
                        return false;
                    }
                }
            }
        }
        return true; // All cells are available
    }

    /**
     * Scans the entire board for fully filled rows AND columns.
     * Clears them simultaneously and returns the total number of lines cleared.
     * 
     * Algorithm:
     * 1. Iterate over all 8 rows — mark any row where ALL 8 cells are occupied
     * 2. Iterate over all 8 columns — mark any column where ALL 8 cells are occupied
     * 3. Clear all marked rows and columns at once (simultaneous clearing)
     * 4. Return the count of cleared lines
     * 
     * @return the number of rows + columns that were fully cleared
     */
    public int clearFullLines() {
        // Boolean flags for rows that need clearing
        boolean[] fullRows = new boolean[ROWS];
        // Boolean flags for columns that need clearing
        boolean[] fullCols = new boolean[COLS];

        // --- PHASE 1: Detect fully filled rows ---
        // Outer loop: iterate over each row
        for (int row = 0; row < ROWS; row++) {
            boolean isFull = true; // Assume row is full until proven otherwise
            // Inner loop: check every cell in this row
            for (int col = 0; col < COLS; col++) {
                if (!grid[row][col]) {
                    isFull = false; // Found an empty cell — row is NOT full
                    break;          // Short-circuit: no need to check remaining cells
                }
            }
            fullRows[row] = isFull; // Store the result for this row
        }

        // --- PHASE 2: Detect fully filled columns ---
        // Outer loop: iterate over each column
        for (int col = 0; col < COLS; col++) {
            boolean isFull = true; // Assume column is full until proven otherwise
            // Inner loop: check every cell in this column
            for (int row = 0; row < ROWS; row++) {
                if (!grid[row][col]) {
                    isFull = false; // Found an empty cell — column is NOT full
                    break;          // Short-circuit
                }
            }
            fullCols[col] = isFull; // Store the result for this column
        }

        // --- PHASE 3: Clear all marked rows and columns simultaneously ---
        int linesCleared = 0; // Counter for total lines cleared

        // Clear marked rows — set all cells in the row to false and null color
        for (int row = 0; row < ROWS; row++) {
            if (fullRows[row]) {
                // Inner loop: reset every cell in this full row
                for (int col = 0; col < COLS; col++) {
                    grid[row][col] = false;       // Unmark occupancy
                    gridColor[row][col] = null;    // Clear the color
                }
                linesCleared++; // Increment the cleared lines counter
            }
        }

        // Clear marked columns — set all cells in the column to false and null color
        for (int col = 0; col < COLS; col++) {
            if (fullCols[col]) {
                // Inner loop: reset every cell in this full column
                for (int row = 0; row < ROWS; row++) {
                    grid[row][col] = false;       // Unmark occupancy
                    gridColor[row][col] = null;    // Clear the color
                }
                linesCleared++; // Increment the cleared lines counter
            }
        }

        // Return the total number of lines (rows + columns) cleared
        return linesCleared;
    }

    /**
     * Counts the total number of occupied cells on the board.
     * Used for game-over detection and board-fullness heuristics.
     * 
     * @return number of occupied cells
     */
    public int getOccupiedCellCount() {
        int count = 0;
        // Nested loop: scan every cell in the 2D array
        for (int row = 0; row < ROWS; row++) {
            for (int col = 0; col < COLS; col++) {
                if (grid[row][col]) {
                    count++; // Cell is occupied — increment counter
                }
            }
        }
        return count;
    }

    /**
     * Returns the number of empty (unoccupied) cells on the board.
     * Useful for checking if there is any room left to place blocks.
     * 
     * @return number of empty cells
     */
    public int getEmptyCellCount() {
        // Total cells minus occupied cells
        return (ROWS * COLS) - getOccupiedCellCount();
    }

    /**
     * Resets the board to an empty state.
     * All cells are set to false (unoccupied).
     */
    public void clear() {
        // Nested loop: reset every cell in the grid
        for (int row = 0; row < ROWS; row++) {
            for (int col = 0; col < COLS; col++) {
                grid[row][col] = false;       // Unmark occupancy
                gridColor[row][col] = null;    // Clear color
            }
        }
    }

    /**
     * Returns a copy of the grid for external rendering (view layer).
     * Defensive copying prevents external modification of internal state.
     * 
     * @return a deep copy of the occupancy grid
     */
    public boolean[][] getGridCopy() {
        boolean[][] copy = new boolean[ROWS][COLS];
        // Nested loop: copy each cell value
        for (int row = 0; row < ROWS; row++) {
            System.arraycopy(grid[row], 0, copy[row], 0, COLS);
        }
        return copy;
    }
}
