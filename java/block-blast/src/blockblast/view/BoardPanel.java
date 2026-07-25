package blockblast.view;

import blockblast.model.Block;
import blockblast.model.Board;
import javax.swing.*;
import java.awt.*;

/**
 * BoardPanel.java
 * 
 * Custom Swing JPanel that renders the 8x8 game board.
 * Draws the grid lines, occupied cells with their colors, ghost preview, and cell borders.
 * 
 * Responsibilities:
 * - Paint the 8x8 grid with consistent cell sizing
 * - Render occupied cells with their assigned block colors
 * - Show ghost/preview overlay during drag-and-drop
 * - Convert pixel coordinates to grid row/column indices
 * 
 * Design: Extends JPanel, overrides paintComponent for custom rendering.
 * Reads from Board model — contains no game logic.
 */
public class BoardPanel extends JPanel {

    /** Size of each cell in pixels */
    public static final int CELL_SIZE = 50;

    /** Padding around the grid edges (in pixels) */
    private static final int PADDING = 10;

    /** Grid line thickness */
    private static final int LINE_WIDTH = 2;

    /** Background color for empty cells */
    private static final Color EMPTY_CELL_COLOR = new Color(30, 30, 50);

    /** Grid line color */
    private static final Color GRID_LINE_COLOR = new Color(60, 60, 80);

    /** Border color for the panel */
    private static final Color BORDER_COLOR = new Color(100, 100, 140);

    /** The board model to render */
    private Board board;

    // --- Ghost preview state (for drag-and-drop feedback) ---

    /** Grid row for the ghost preview (-1 = no preview) */
    private int ghostRow = -1;

    /** Grid column for the ghost preview */
    private int ghostCol = -1;

    /** The actual Block object being previewed (avoids index lookup bug) */
    private Block ghostBlock = null;

    /** Color of the block being previewed */
    private Color ghostColor = null;

    /** Whether the current ghost position is a valid placement */
    private boolean ghostValid = false;

    /**
     * Constructor: creates the BoardPanel with fixed dimensions
     * based on the 8x8 grid and cell size.
     */
    public BoardPanel() {
        int width = (Board.COLS * CELL_SIZE) + (2 * PADDING);
        int height = (Board.ROWS * CELL_SIZE) + (2 * PADDING);
        setPreferredSize(new Dimension(width, height));
        setOpaque(false);
    }

    /**
     * Sets the board model to render.
     * Triggers a repaint to display the updated board state.
     * 
     * @param board the Board instance to display
     */
    public void setBoard(Board board) {
        this.board = board;
        repaint();
    }

    /**
     * Sets the Block object to use for ghost preview rendering.
     * Called by GameFrame during drag to provide the actual Block shape.
     * 
     * @param block the Block being dragged
     * @param color the color of the block
     */
    public void setGhostBlock(Block block, Color color) {
        this.ghostBlock = block;
        this.ghostColor = color;
    }

    /**
     * Sets the ghost/preview position on the grid.
     * Shows where the block would land if dropped at this position.
     * 
     * @param row   the grid row under the cursor (-1 = no preview)
     * @param col   the grid column under the cursor
     * @param valid whether the placement is valid at this position
     */
    public void setGhostPosition(int row, int col, boolean valid) {
        this.ghostRow = row;
        this.ghostCol = col;
        this.ghostValid = valid;
        repaint();
    }

    /**
     * Clears the ghost preview entirely.
     */
    public void clearGhost() {
        this.ghostRow = -1;
        this.ghostCol = -1;
        this.ghostBlock = null;
        this.ghostColor = null;
        this.ghostValid = false;
        repaint();
    }

    /**
     * Custom painting method — renders the entire board.
     * Called automatically by Swing when the panel needs repainting.
     * 
     * @param g the Graphics context to draw on
     */
    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        // Enable anti-aliasing for smoother rendering
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        // Draw background
        g2.setColor(new Color(20, 20, 35));
        g2.fillRect(0, 0, getWidth(), getHeight());

        // Draw the 8x8 grid
        drawGrid(g2);

        // Draw occupied cells with their colors
        drawOccupiedCells(g2);

        // Draw ghost preview overlay (if active)
        drawGhostPreview(g2);
    }

    /**
     * Draws the empty grid with cell borders.
     * Nested loop iterates over all ROWS x COLS cells.
     * 
     * @param g2 the Graphics2D context
     */
    private void drawGrid(Graphics2D g2) {
        for (int row = 0; row < Board.ROWS; row++) {
            for (int col = 0; col < Board.COLS; col++) {
                int x = PADDING + (col * CELL_SIZE);
                int y = PADDING + (row * CELL_SIZE);

                // Draw cell background
                g2.setColor(EMPTY_CELL_COLOR);
                g2.fillRect(x + 1, y + 1, CELL_SIZE - 2, CELL_SIZE - 2);

                // Draw cell border (subtle grid lines)
                g2.setColor(GRID_LINE_COLOR);
                g2.setStroke(new BasicStroke(LINE_WIDTH));
                g2.drawRect(x, y, CELL_SIZE, CELL_SIZE);
            }
        }

        // Draw outer border
        g2.setColor(BORDER_COLOR);
        g2.setStroke(new BasicStroke(3));
        g2.drawRect(PADDING - 1, PADDING - 1,
                (Board.COLS * CELL_SIZE) + 2, (Board.ROWS * CELL_SIZE) + 2);
    }

    /**
     * Draws all occupied cells with their assigned block colors.
     * Includes 3D highlight and shadow effects for visual depth.
     * 
     * @param g2 the Graphics2D context
     */
    private void drawOccupiedCells(Graphics2D g2) {
        if (board == null) return;

        // Nested loop: scan every cell in the 8x8 grid
        for (int row = 0; row < Board.ROWS; row++) {
            for (int col = 0; col < Board.COLS; col++) {
                if (board.isOccupied(row, col)) {
                    int x = PADDING + (col * CELL_SIZE);
                    int y = PADDING + (row * CELL_SIZE);

                    Color cellColor = board.getCellColor(row, col);
                    if (cellColor != null) {
                        // Draw main cell fill
                        g2.setColor(cellColor);
                        g2.fillRect(x + 2, y + 2, CELL_SIZE - 4, CELL_SIZE - 4);

                        // Draw highlight (top and left edges)
                        g2.setColor(cellColor.brighter());
                        g2.fillRect(x + 2, y + 2, CELL_SIZE - 4, 3);
                        g2.fillRect(x + 2, y + 2, 3, CELL_SIZE - 4);

                        // Draw shadow (bottom and right edges)
                        g2.setColor(cellColor.darker());
                        g2.fillRect(x + 2, y + CELL_SIZE - 5, CELL_SIZE - 4, 3);
                        g2.fillRect(x + CELL_SIZE - 5, y + 2, 3, CELL_SIZE - 4);
                    } else {
                        // Fallback color if no color stored
                        g2.setColor(new Color(150, 150, 150));
                        g2.fillRect(x + 2, y + 2, CELL_SIZE - 4, CELL_SIZE - 4);
                    }
                }
            }
        }
    }

    /**
     * Draws a semi-transparent preview of where the dragged block would land.
     * Shows green tint for valid placement, red tint for invalid.
     * 
     * @param g2 the Graphics2D context
     */
    private void drawGhostPreview(Graphics2D g2) {
        // Only draw if ghost data is set
        if (ghostRow < 0 || ghostCol < 0 || ghostBlock == null) {
            return;
        }

        // Choose color: block color (valid) or red tint (invalid)
        Color previewColor = ghostValid
                ? new Color(ghostColor.getRed(), ghostColor.getGreen(), ghostColor.getBlue(), 100)
                : new Color(255, 50, 50, 80);

        Color borderColor = ghostValid ? ghostColor : new Color(255, 50, 50);

        // Nested loop: iterate over the block's shape matrix
        for (int r = 0; r < ghostBlock.getRows(); r++) {
            for (int c = 0; c < ghostBlock.getCols(); c++) {
                if (ghostBlock.isFilled(r, c)) {
                    int gridRow = ghostRow + r;
                    int gridCol = ghostCol + c;

                    // Only draw if within grid bounds
                    if (gridRow >= 0 && gridRow < Board.ROWS
                            && gridCol >= 0 && gridCol < Board.COLS) {
                        int x = PADDING + (gridCol * CELL_SIZE);
                        int y = PADDING + (gridRow * CELL_SIZE);

                        // Draw semi-transparent preview cell
                        g2.setColor(previewColor);
                        g2.fillRect(x + 2, y + 2, CELL_SIZE - 4, CELL_SIZE - 4);

                        // Draw border to outline the shape
                        g2.setColor(borderColor);
                        g2.setStroke(new BasicStroke(2));
                        g2.drawRect(x + 2, y + 2, CELL_SIZE - 4, CELL_SIZE - 4);
                    }
                }
            }
        }
    }

    /**
     * Converts a Y pixel coordinate to a grid row index.
     * Accounts for the PADDING offset at the top.
     * 
     * @param pixelY the Y pixel coordinate (relative to this panel)
     * @return the grid row (0-7), or -1 if outside the grid
     */
    public int pixelToRow(int pixelY) {
        int row = (pixelY - PADDING) / CELL_SIZE;
        return (row >= 0 && row < Board.ROWS) ? row : -1;
    }

    /**
     * Converts an X pixel coordinate to a grid column index.
     * Accounts for the PADDING offset on the left.
     * 
     * @param pixelX the X pixel coordinate (relative to this panel)
     * @return the grid column (0-7), or -1 if outside the grid
     */
    public int pixelToCol(int pixelX) {
        int col = (pixelX - PADDING) / CELL_SIZE;
        return (col >= 0 && col < Board.COLS) ? col : -1;
    }
}
