package blockblast;

import blockblast.model.GameEngine;
import blockblast.view.GameFrame;
import javax.swing.*;

/**
 * BlockBlastGame.java
 * 
 * Main entry point for the Block Blast game application.
 * Initializes the game engine, creates the main window, and starts the game loop.
 * 
 * Responsibilities:
 * - Set up the Swing Look-and-Feel
 * - Create the GameEngine (model) and GameFrame (view)
 * - Start the game on the Swing Event Dispatch Thread
 * 
 * Design: Follows standard Swing application startup pattern.
 * The game uses MVC architecture:
 *   Model: Board, Block, GameEngine
 *   View: BoardPanel, BlockPiecePanel, GameFrame
 *   Controller: GameController
 */
public class BlockBlastGame {

    /**
     * Main method — application entry point.
     * 
     * @param args command-line arguments (not used)
     */
    public static void main(String[] args) {
        // Set the Look-and-Feel to the system default for native appearance
        try {
            UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
        } catch (Exception e) {
            // Fallback to default Swing L&F if system L&F is unavailable
            System.err.println("Could not set system look-and-feel: " + e.getMessage());
        }

        // Launch the Swing application on the Event Dispatch Thread (EDT)
        // This is the recommended way to start Swing applications for thread safety
        SwingUtilities.invokeLater(() -> {
            // Create the game engine (model layer)
            GameEngine engine = new GameEngine();

            // Create the main game window (view layer)
            GameFrame frame = new GameFrame(engine);

            // Make the window visible
            frame.setVisible(true);
        });
    }
}
