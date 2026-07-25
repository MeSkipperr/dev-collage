package blockblast.view;

import blockblast.controller.GameController;
import blockblast.model.Block;
import blockblast.model.GameEngine;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.List;

/**
 * GameFrame.java
 * 
 * Main application window for Block Blast.
 * Uses a Glass Pane overlay for smooth cross-component drag-and-drop.
 * 
 * The glass pane is a transparent JPanel that sits on top of all children
 * in the JFrame. During a drag, it captures ALL mouse events (regardless
 * of which child component the cursor is over) and renders the floating
 * block preview. This solves the Swing limitation where mouseMotionListener
 * only fires on the component the cursor is currently over.
 * 
 * Responsibilities:
 * - Create and layout the main game window
 * - Manage drag-and-drop via glass pane overlay
 * - Display the board, block pieces, score, and game-over overlay
 * - Update the UI when game state changes
 * 
 * Design: MVC — View coordinator. Delegates logic to GameController.
 */
public class GameFrame extends JFrame {

    /** The game engine (model) */
    private final GameEngine engine;

    /** The game controller — mediates input to model */
    private final GameController controller;

    /** The board rendering panel */
    private final BoardPanel boardPanel;

    /** The 3 block piece panels for the current turn */
    private final BlockPiecePanel[] blockPanels;

    /** The bottom panel holding block pieces (needed for refresh) */
    private JPanel bottomPanel;

    /** Score display label */
    private JLabel scoreLabel;

    /** Lines cleared display label */
    private JLabel linesLabel;

    /** High score display label */
    private JLabel highScoreLabel;

    /** Game-over overlay panel */
    private JPanel gameOverPanel;

    // --- Drag-and-Drop State ---

    /** The glass pane used for drag-and-drop rendering */
    private JPanel dragGlassPane;

    /** Whether a block is currently being dragged */
    private boolean dragging = false;

    /** Index of the block being dragged (0, 1, or 2) */
    private int dragBlockIndex = -1;

    /** The Block object being dragged */
    private Block dragBlock = null;

    /** The color of the block being dragged */
    private Color dragColor = null;

    /** Current mouse position in screen coordinates during drag */
    private int dragMouseX = 0;
    private int dragMouseY = 0;

    /**
     * Constructor: builds the complete game window layout.
     * 
     * @param engine the GameEngine instance (model)
     */
    public GameFrame(GameEngine engine) {
        this.engine = engine;
        this.controller = new GameController(engine);
        this.blockPanels = new BlockPiecePanel[3];

        // Initialize game state so blocks exist before building UI
        engine.startNewGame();

        // Configure the JFrame
        setTitle("Block Blast");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setResizable(false);

        // Create the main panel with BorderLayout
        JPanel mainPanel = new JPanel(new BorderLayout());
        mainPanel.setBackground(new Color(15, 15, 30));
        mainPanel.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));

        // Create the top bar (score, lines, high score)
        JPanel topBar = createTopBar();
        mainPanel.add(topBar, BorderLayout.NORTH);

        // Create the board panel (center)
        boardPanel = new BoardPanel();
        boardPanel.setBoard(engine.getBoard());
        mainPanel.add(boardPanel, BorderLayout.CENTER);

        // Create the bottom panel (block pieces)
        bottomPanel = createBottomPanel();
        mainPanel.add(bottomPanel, BorderLayout.SOUTH);

        // Create game-over overlay (initially hidden)
        gameOverPanel = createGameOverOverlay();
        gameOverPanel.setVisible(false);

        // Add everything to the frame
        setLayout(new BorderLayout());
        add(mainPanel, BorderLayout.CENTER);
        add(gameOverPanel, BorderLayout.PAGE_END);

        // Pack the window to fit preferred sizes
        pack();
        setLocationRelativeTo(null); // Center on screen

        // Set up the glass pane for drag-and-drop
        setupGlassPane();
    }

    // =========================================================================
    // UI CONSTRUCTION
    // =========================================================================

    /**
     * Creates the top bar with score, lines cleared, and high score displays.
     */
    private JPanel createTopBar() {
        JPanel topBar = new JPanel(new GridLayout(1, 3, 10, 0));
        topBar.setOpaque(false);
        topBar.setBorder(BorderFactory.createEmptyBorder(5, 0, 10, 0));

        scoreLabel = new JLabel("Score: 0", SwingConstants.CENTER);
        scoreLabel.setForeground(new Color(255, 215, 0));
        scoreLabel.setFont(new Font("SansSerif", Font.BOLD, 18));
        topBar.add(scoreLabel);

        linesLabel = new JLabel("Lines: 0", SwingConstants.CENTER);
        linesLabel.setForeground(new Color(100, 255, 100));
        linesLabel.setFont(new Font("SansSerif", Font.BOLD, 18));
        topBar.add(linesLabel);

        highScoreLabel = new JLabel("Best: 0", SwingConstants.CENTER);
        highScoreLabel.setForeground(new Color(200, 200, 255));
        highScoreLabel.setFont(new Font("SansSerif", Font.BOLD, 18));
        topBar.add(highScoreLabel);

        return topBar;
    }

    /**
     * Creates the bottom panel containing the 3 block piece panels.
     */
    private JPanel createBottomPanel() {
        JPanel panel = new JPanel(new FlowLayout(FlowLayout.CENTER, 20, 10));
        panel.setOpaque(false);
        panel.setBorder(BorderFactory.createEmptyBorder(10, 0, 0, 0));

        List<Block> blocks = engine.getCurrentBlocks();
        List<Color> colors = engine.getCurrentColors();

        for (int i = 0; i < 3; i++) {
            blockPanels[i] = new BlockPiecePanel(blocks.get(i), colors.get(i), i);
            panel.add(blockPanels[i]);
        }

        return panel;
    }

    /**
     * Creates the game-over overlay panel with restart button.
     */
    private JPanel createGameOverOverlay() {
        JPanel overlay = new JPanel();
        overlay.setLayout(new BoxLayout(overlay, BoxLayout.Y_AXIS));
        overlay.setBackground(new Color(0, 0, 0, 180));
        overlay.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));

        JLabel titleLabel = new JLabel("GAME OVER");
        titleLabel.setForeground(new Color(255, 80, 80));
        titleLabel.setFont(new Font("SansSerif", Font.BOLD, 36));
        titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        overlay.add(titleLabel);

        overlay.add(Box.createRigidArea(new Dimension(0, 15)));

        JLabel finalScoreLabel = new JLabel("Final Score: 0");
        finalScoreLabel.setName("finalScoreLabel");
        finalScoreLabel.setForeground(Color.WHITE);
        finalScoreLabel.setFont(new Font("SansSerif", Font.BOLD, 22));
        finalScoreLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        overlay.add(finalScoreLabel);

        overlay.add(Box.createRigidArea(new Dimension(0, 10)));

        JButton restartButton = new JButton("Play Again");
        restartButton.setAlignmentX(Component.CENTER_ALIGNMENT);
        restartButton.setFont(new Font("SansSerif", Font.BOLD, 18));
        restartButton.setBackground(new Color(46, 204, 113));
        restartButton.setForeground(Color.WHITE);
        restartButton.setFocusPainted(false);
        restartButton.setBorderPainted(false);
        restartButton.setOpaque(true);
        restartButton.setCursor(new Cursor(Cursor.HAND_CURSOR));
        restartButton.addActionListener(e -> restartGame());
        overlay.add(restartButton);

        return overlay;
    }

    // =========================================================================
    // GLASS PANE DRAG-AND-DROP SYSTEM
    // =========================================================================

    /**
     * Sets up the glass pane for drag-and-drop.
     * 
     * The glass pane is a transparent JPanel that covers the entire JFrame.
     * During a drag operation, it:
     * 1. Captures ALL mouse events (pressed, dragged, released)
     * 2. Renders the floating block preview at the cursor position
     * 3. Determines drop validity by converting cursor to grid coordinates
     * 
     * This works because the glass pane sits ABOVE all child components
     * in the JFrame's z-order, so it receives mouse events regardless of
     * which component the cursor is over.
     */
    private void setupGlassPane() {
        // Create a custom glass pane that can paint the floating block
        dragGlassPane = new JPanel() {
            @Override
            protected void paintComponent(Graphics g) {
                // Call parent to clear background
                super.paintComponent(g);

                // Only render the floating block if actively dragging
                if (!dragging || dragBlock == null) return;

                Graphics2D g2 = (Graphics2D) g;
                g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING,
                        RenderingHints.VALUE_ANTIALIAS_ON);

                // Convert screen coordinates to glass pane local coordinates
                Point local = SwingUtilities.convertPoint(
                        null, dragMouseX, dragMouseY, dragGlassPane);

                // Center the block shape on the cursor position
                int blockPixelWidth = dragBlock.getCols() * BoardPanel.CELL_SIZE;
                int blockPixelHeight = dragBlock.getRows() * BoardPanel.CELL_SIZE;
                int offsetX = local.x - blockPixelWidth / 2;
                int offsetY = local.y - blockPixelHeight / 2;

                // Draw each filled cell of the block shape
                for (int r = 0; r < dragBlock.getRows(); r++) {
                    for (int c = 0; c < dragBlock.getCols(); c++) {
                        if (dragBlock.isFilled(r, c)) {
                            int cellX = offsetX + (c * BoardPanel.CELL_SIZE);
                            int cellY = offsetY + (r * BoardPanel.CELL_SIZE);

                            // Main cell fill with transparency
                            g2.setColor(new Color(
                                    dragColor.getRed(), dragColor.getGreen(),
                                    dragColor.getBlue(), 200));
                            g2.fillRoundRect(cellX + 2, cellY + 2,
                                    BoardPanel.CELL_SIZE - 4,
                                    BoardPanel.CELL_SIZE - 4, 6, 6);

                            // 3D highlight (top and left edges)
                            g2.setColor(dragColor.brighter());
                            g2.fillRect(cellX + 2, cellY + 2,
                                    BoardPanel.CELL_SIZE - 4, 3);
                            g2.fillRect(cellX + 2, cellY + 2,
                                    3, BoardPanel.CELL_SIZE - 4);

                            // 3D shadow (bottom and right edges)
                            g2.setColor(dragColor.darker());
                            g2.fillRect(cellX + 2,
                                    cellY + BoardPanel.CELL_SIZE - 5,
                                    BoardPanel.CELL_SIZE - 4, 3);
                            g2.fillRect(cellX + BoardPanel.CELL_SIZE - 5,
                                    cellY + 2, 3, BoardPanel.CELL_SIZE - 4);

                            // Cell border
                            g2.setColor(dragColor.darker().darker());
                            g2.setStroke(new BasicStroke(1.5f));
                            g2.drawRoundRect(cellX + 2, cellY + 2,
                                    BoardPanel.CELL_SIZE - 4,
                                    BoardPanel.CELL_SIZE - 4, 6, 6);
                        }
                    }
                }
            }
        };

        dragGlassPane.setOpaque(false);
        dragGlassPane.setVisible(true);

        // Replace the default glass pane with our custom one
        setGlassPane(dragGlassPane);

        // --- MOUSE PRESSED on glass pane ---
        // Fires when user clicks anywhere in the frame.
        // Checks if click is on a block piece panel to start a drag.
        dragGlassPane.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                int hitIndex = findBlockPieceAt(e.getPoint());
                if (hitIndex >= 0
                        && !blockPanels[hitIndex].isPlaced()
                        && !engine.isGameOver()) {
                    // Start dragging this block
                    dragging = true;
                    dragBlockIndex = hitIndex;
                    dragBlock = engine.getCurrentBlocks().get(hitIndex);
                    dragColor = engine.getCurrentColors().get(hitIndex);
                    dragMouseX = e.getXOnScreen();
                    dragMouseY = e.getYOnScreen();

                    // Visual feedback: highlight the selected piece
                    blockPanels[hitIndex].setSelected(true);
                }
            }

            @Override
            public void mouseReleased(MouseEvent e) {
                if (!dragging) return;

                // Convert screen coordinates to board panel local coordinates
                Point boardLocal = SwingUtilities.convertPoint(
                        dragGlassPane, e.getPoint(), boardPanel);
                int row = boardPanel.pixelToRow(boardLocal.y);
                int col = boardPanel.pixelToCol(boardLocal.x);

                // Attempt to place the block on the board
                if (row >= 0 && col >= 0) {
                    boolean placed = controller.handleBlockPlacement(
                            dragBlockIndex, row, col);
                    if (placed) {
                        blockPanels[dragBlockIndex].setPlaced(true);
                    }
                }

                // Clear ghost preview on the board
                boardPanel.clearGhost();

                // Reset drag state
                dragging = false;
                dragBlockIndex = -1;
                dragBlock = null;
                dragColor = null;

                // Repaint to clear the floating block
                dragGlassPane.repaint();

                // Refresh all UI
                boardPanel.repaint();
                updateUI();
                refreshBlockPanels();

                // Check game-over
                if (engine.isGameOver()) {
                    showGameOver();
                }
            }
        });

        // --- MOUSE DRAGGED on glass pane ---
        // Fires as the mouse moves while a button is held down.
        // Updates the ghost preview on the board and the floating block position.
        dragGlassPane.addMouseMotionListener(new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent e) {
                if (!dragging) return;

                // Update current drag position (screen coordinates)
                dragMouseX = e.getXOnScreen();
                dragMouseY = e.getYOnScreen();

                // Convert to board-local coordinates for grid snapping
                Point boardLocal = SwingUtilities.convertPoint(
                        dragGlassPane, e.getPoint(), boardPanel);
                int row = boardPanel.pixelToRow(boardLocal.y);
                int col = boardPanel.pixelToCol(boardLocal.x);

                // Check if placement is valid at this grid position
                boolean valid = (row >= 0 && col >= 0)
                        ? engine.canPlaceAt(dragBlockIndex, row, col)
                        : false;

                // Update the ghost preview on the board panel
                boardPanel.setGhostBlock(dragBlock, dragColor);
                boardPanel.setGhostPosition(row, col, valid);

                // Repaint glass pane (renders the floating block at new position)
                dragGlassPane.repaint();
            }
        });
    }

    /**
     * Finds which block piece panel (if any) contains the given point.
     * Converts the point from glass-pane coordinates to each panel's local
     * coordinate system and checks containment.
     * 
     * @param p the point in glass pane coordinates
     * @return the block index (0-2) if hit, -1 otherwise
     */
    private int findBlockPieceAt(Point p) {
        // Check each block piece panel
        for (int i = 0; i < 3; i++) {
            // Convert point from glass pane to the block panel's local coords
            Point local = SwingUtilities.convertPoint(
                    getGlassPane(), p, blockPanels[i]);
            // Check if the converted point is within the panel's bounds
            if (blockPanels[i].contains(local)) {
                return i;
            }
        }
        return -1; // No block piece was hit
    }

    // =========================================================================
    // UI UPDATES
    // =========================================================================

    /**
     * Updates all UI elements with current game state.
     */
    public void updateUI() {
        scoreLabel.setText("Score: " + engine.getScore());
        linesLabel.setText("Lines: " + engine.getTotalLinesCleared());
        highScoreLabel.setText("Best: " + engine.getHighScore());
    }

    /**
     * Refreshes the block piece panels for the current turn.
     * Rebuilds the bottom panel with updated block states and re-attaches
     * the block panel references so findBlockPieceAt() works correctly.
     */
    private void refreshBlockPanels() {
        List<Block> blocks = engine.getCurrentBlocks();
        List<Color> colors = engine.getCurrentColors();

        bottomPanel.removeAll();

        for (int i = 0; i < 3; i++) {
            blockPanels[i] = new BlockPiecePanel(blocks.get(i), colors.get(i), i);
            // Mark blocks that have already been placed this turn
            if (i < engine.getBlocksPlacedThisTurn()) {
                blockPanels[i].setPlaced(true);
            }
            bottomPanel.add(blockPanels[i]);
        }

        bottomPanel.revalidate();
        bottomPanel.repaint();
    }

    /**
     * Displays the game-over overlay with final score.
     */
    private void showGameOver() {
        // Find the final score label by name and update its text
        for (java.awt.Component comp : gameOverPanel.getComponents()) {
            if (comp instanceof JLabel) {
                JLabel label = (JLabel) comp;
                if ("finalScoreLabel".equals(label.getName())) {
                    label.setText("Final Score: " + engine.getScore());
                }
            }
        }

        gameOverPanel.setVisible(true);
        revalidate();
        repaint();
    }

    /**
     * Restarts the game by resetting engine state and refreshing the UI.
     */
    private void restartGame() {
        engine.startNewGame();
        gameOverPanel.setVisible(false);
        boardPanel.setBoard(engine.getBoard());
        refreshBlockPanels();
        updateUI();
        revalidate();
        repaint();
    }

    /**
     * Starts the game by generating the first turn.
     */
    public void startGame() {
        engine.startNewGame();
        updateUI();
        refreshBlockPanels();
        repaint();
    }
}
