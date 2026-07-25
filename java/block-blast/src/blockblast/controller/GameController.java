package blockblast.controller;

import blockblast.model.Block;
import blockblast.model.Board;
import blockblast.model.GameEngine;

/**
 * GameController.java
 * 
 * Mediates between the View (GUI) and Model (GameEngine) layers.
 * Handles user input events and translates them into game model operations.
 * 
 * Responsibilities:
 * - Receive user actions from the View (block placement attempts)
 * - Validate and forward actions to the GameEngine
 * - Return results back to the View for display updates
 * 
 * Design: Implements the Controller role in the MVC pattern.
 * Contains NO GUI code — delegates rendering to the View layer.
 * Contains NO grid management — delegates to the Model layer.
 */
public class GameController {

    /** The game engine instance this controller manages */
    private final GameEngine engine;

    /**
     * Constructor: injects the GameEngine dependency.
     * 
     * @param engine the GameEngine to control
     */
    public GameController(GameEngine engine) {
        this.engine = engine;
    }

    /**
     * Handles a block placement attempt from the user.
     * Called when the user drags a block onto the board and releases.
     * 
     * @param blockIndex the index of the block in the current turn (0, 1, or 2)
     * @param startRow   the grid row where placement is attempted
     * @param startCol   the grid column where placement is attempted
     * @return true if the placement succeeded, false otherwise
     */
    public boolean handleBlockPlacement(int blockIndex, int startRow, int startCol) {
        // Delegate placement to the game engine
        // The engine handles validation, board modification, scoring, and turn management
        return engine.placeBlock(blockIndex, startRow, startCol);
    }

    /**
     * Handles a new game request from the user.
     * Resets all game state and starts fresh.
     */
    public void handleNewGame() {
        engine.startNewGame();
    }

    /**
     * Checks if a specific placement is valid (for preview/ghost display).
     * 
     * @param blockIndex the block to check
     * @param row        the grid row
     * @param col        the grid column
     * @return true if the placement would be valid
     */
    public boolean isValidPlacement(int blockIndex, int row, int col) {
        return engine.canPlaceAt(blockIndex, row, col);
    }

    /**
     * Returns the game engine for state queries.
     * 
     * @return the GameEngine instance
     */
    public GameEngine getEngine() {
        return engine;
    }
}
