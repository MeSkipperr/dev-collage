package blockblast.view;

import blockblast.model.Block;
import javax.swing.*;
import java.awt.*;

/**
 * BlockPiecePanel.java
 * 
 * Custom Swing JPanel that renders a single block shape as a draggable piece.
 * Displays the block's cells in a compact grid format for the player to select.
 * 
 * Responsibilities:
 * - Render a block shape as a visual panel
 * - Show the block's cells in the correct pattern with assigned color
 * - Indicate whether the block has been placed (grayed out)
 * 
 * Design: Each block in the current turn gets its own BlockPiecePanel.
 * The GameFrame arranges 3 of these panels in a row at the bottom.
 */
public class BlockPiecePanel extends JPanel {

    /** Size of each cell within the piece preview */
    private static final int PIECE_CELL_SIZE = 25;

    /** Padding around the piece within the panel */
    private static final int PIECE_PADDING = 5;

    /** The block shape to render */
    private Block block;

    /** The color assigned to this block */
    private Color blockColor;

    /** Whether this block has already been placed (disabled appearance) */
    private boolean placed = false;

    /** Whether this block is currently selected (being dragged) */
    private boolean selected = false;

    /** Index of this block in the current turn (0, 1, or 2) */
    private int blockIndex;

    /**
     * Constructor: creates a BlockPiecePanel for a given block.
     * 
     * @param block      the Block shape to display
     * @param blockColor the color to render the block cells
     * @param blockIndex the index of this block in the current turn
     */
    public BlockPiecePanel(Block block, Color blockColor, int blockIndex) {
        this.block = block;
        this.blockColor = blockColor;
        this.blockIndex = blockIndex;

        // Calculate preferred size based on block dimensions
        int width = (block.getCols() * PIECE_CELL_SIZE) + (2 * PIECE_PADDING);
        int height = (block.getRows() * PIECE_CELL_SIZE) + (2 * PIECE_PADDING);
        setPreferredSize(new Dimension(width, height));

        setOpaque(false); // Transparent background
    }

    /**
     * Marks this block as placed (grayed out appearance).
     */
    public void setPlaced(boolean placed) {
        this.placed = placed;
        repaint();
    }

    /**
     * Marks this block as selected (highlighted border during drag).
     */
    public void setSelected(boolean selected) {
        this.selected = selected;
        repaint();
    }

    /**
     * Returns whether this block has been placed.
     */
    public boolean isPlaced() {
        return placed;
    }

    /**
     * Returns whether this block is currently selected.
     */
    public boolean isSelected() {
        return selected;
    }

    /**
     * Returns the block index for this piece.
     */
    public int getBlockIndex() {
        return blockIndex;
    }

    /**
     * Custom painting method — renders the block shape.
     * Shows normal appearance, grayed-out if placed, or highlighted if selected.
     * 
     * @param g the Graphics context
     */
    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        if (block == null) return;

        Graphics2D g2 = (Graphics2D) g;
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        // Draw selection highlight behind the block (if selected)
        if (selected && !placed) {
            g2.setColor(new Color(255, 255, 255, 40));
            g2.fillRoundRect(0, 0, getWidth(), getHeight(), 8, 8);
            g2.setColor(new Color(255, 255, 255, 180));
            g2.setStroke(new BasicStroke(2));
            g2.drawRoundRect(1, 1, getWidth() - 3, getHeight() - 3, 8, 8);
        }

        // Choose color: normal, grayed-out (placed), or dimmed (selected)
        Color drawColor;
        if (placed) {
            drawColor = new Color(80, 80, 80, 120);
        } else if (selected) {
            // Slightly dimmed to indicate it's being dragged from here
            drawColor = new Color(
                    blockColor.getRed(), blockColor.getGreen(),
                    blockColor.getBlue(), 100);
        } else {
            drawColor = blockColor;
        }

        // Nested loop: iterate over the block's shape matrix
        for (int r = 0; r < block.getRows(); r++) {
            for (int c = 0; c < block.getCols(); c++) {
                if (block.isFilled(r, c)) {
                    int x = PIECE_PADDING + (c * PIECE_CELL_SIZE);
                    int y = PIECE_PADDING + (r * PIECE_CELL_SIZE);

                    // Draw the cell with color
                    g2.setColor(drawColor);
                    g2.fillRoundRect(x + 1, y + 1, PIECE_CELL_SIZE - 2, PIECE_CELL_SIZE - 2, 4, 4);

                    // Draw 3D effects (only if not placed and not selected)
                    if (!placed && !selected) {
                        g2.setColor(blockColor.brighter());
                        g2.fillRect(x + 1, y + 1, PIECE_CELL_SIZE - 2, 2);
                        g2.fillRect(x + 1, y + 1, 2, PIECE_CELL_SIZE - 2);

                        g2.setColor(blockColor.darker());
                        g2.fillRect(x + 1, y + PIECE_CELL_SIZE - 3, PIECE_CELL_SIZE - 2, 2);
                        g2.fillRect(x + PIECE_CELL_SIZE - 3, y + 1, 2, PIECE_CELL_SIZE - 2);
                    }

                    // Draw cell border
                    g2.setColor(placed ? new Color(60, 60, 60) : blockColor.darker().darker());
                    g2.setStroke(new BasicStroke(1));
                    g2.drawRoundRect(x + 1, y + 1, PIECE_CELL_SIZE - 2, PIECE_CELL_SIZE - 2, 4, 4);
                }
            }
        }
    }
}
