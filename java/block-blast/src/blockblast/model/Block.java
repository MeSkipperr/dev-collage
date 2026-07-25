package blockblast.model;

import java.util.ArrayList;
import java.util.List;

/**
 * Block.java
 * 
 * Represents a single block shape in Block Blast.
 * Each block is defined by a 2D boolean matrix that specifies its shape.
 * Blocks cannot be rotated — the shape is fixed at creation time.
 * 
 * Responsibilities:
 * - Store the shape matrix (rows x cols of boolean cells)
 * - Provide accessors for shape dimensions and cell state
 * - Generate all available block types used in the game
 * 
 * Design: Immutable — shape data cannot be modified after construction.
 * Uses Encapsulation: shape matrix is private, accessed via getRows/getCols/isFilled.
 */
public class Block {

    /**
     * The 2D boolean matrix defining the block shape.
     * true = filled cell, false = empty cell in the shape.
     * Encapsulated: private access, read-only through public methods.
     */
    private final boolean[][] shape;

    /**
     * Number of rows in the shape matrix.
     */
    private final int rows;

    /**
     * Number of columns in the shape matrix.
     */
    private final int cols;

    /**
     * The name/label of this block type for display purposes.
     */
    private final String name;

    /**
     * Private constructor: creates a Block from a 2D boolean matrix.
     * 
     * @param shape the 2D boolean array defining the shape
     * @param name  the display name for this block type
     */
    private Block(boolean[][] shape, String name) {
        // Store the shape matrix dimensions
        this.rows = shape.length;
        this.cols = shape[0].length;
        // Deep copy the shape to prevent external modification (defensive copy)
        this.shape = new boolean[rows][cols];
        for (int r = 0; r < rows; r++) {
            System.arraycopy(shape[r], 0, this.shape[r], 0, cols);
        }
        this.name = name;
    }

    /**
     * Returns the number of rows in the shape.
     * @return row count
     */
    public int getRows() {
        return rows;
    }

    /**
     * Returns the number of columns in the shape.
     * @return column count
     */
    public int getCols() {
        return cols;
    }

    /**
     * Checks if a specific cell in the shape is filled.
     * 
     * @param r row index within the shape
     * @param c column index within the shape
     * @return true if the cell is filled, false otherwise
     */
    public boolean isFilled(int r, int c) {
        // Boundary check for safety
        if (r < 0 || r >= rows || c < 0 || c >= cols) {
            return false;
        }
        return shape[r][c];
    }

    /**
     * Returns the name of this block type.
     * @return the block name string
     */
    public String getName() {
        return name;
    }

    /**
     * Counts the total number of filled cells in this block.
     * Used for scoring (10 points per placed block cell).
     * 
     * @return the number of filled cells
     */
    public int getCellCount() {
        int count = 0;
        // Nested loop: iterate over every cell in the shape matrix
        for (int r = 0; r < rows; r++) {
            for (int c = 0; c < cols; c++) {
                if (shape[r][c]) {
                    count++; // Cell is filled — increment counter
                }
            }
        }
        return count;
    }

    // ========================================================================
    // STATIC BLOCK DEFINITIONS
    // All block shapes used in the game are defined here as static constants.
    // Each shape is a 2D boolean array with 'true' representing filled cells.
    // ========================================================================

    /** Single cell block — 1x1 square */
    public static final Block SINGLE = new Block(new boolean[][]{
            {true}
    }, "Single");

    /** Horizontal 2-cell block */
    public static final Block HORIZONTAL_2 = new Block(new boolean[][]{
            {true, true}
    }, "Horizontal 2");

    /** Vertical 2-cell block */
    public static final Block VERTICAL_2 = new Block(new boolean[][]{
            {true},
            {true}
    }, "Vertical 2");

    /** Horizontal 3-cell line */
    public static final Block HORIZONTAL_3 = new Block(new boolean[][]{
            {true, true, true}
    }, "Horizontal 3");

    /** Vertical 3-cell line */
    public static final Block VERTICAL_3 = new Block(new boolean[][]{
            {true},
            {true},
            {true}
    }, "Vertical 3");

    /** Horizontal 4-cell line */
    public static final Block HORIZONTAL_4 = new Block(new boolean[][]{
            {true, true, true, true}
    }, "Horizontal 4");

    /** Vertical 4-cell line */
    public static final Block VERTICAL_4 = new Block(new boolean[][]{
            {true},
            {true},
            {true},
            {true}
    }, "Vertical 4");

    /** Horizontal 5-cell line */
    public static final Block HORIZONTAL_5 = new Block(new boolean[][]{
            {true, true, true, true, true}
    }, "Horizontal 5");

    /** Vertical 5-cell line */
    public static final Block VERTICAL_5 = new Block(new boolean[][]{
            {true},
            {true},
            {true},
            {true},
            {true}
    }, "Vertical 5");

    /** 2x2 square block */
    public static final Block SQUARE_2X2 = new Block(new boolean[][]{
            {true, true},
            {true, true}
    }, "Square 2x2");

    /** 3x3 square block */
    public static final Block SQUARE_3X3 = new Block(new boolean[][]{
            {true, true, true},
            {true, true, true},
            {true, true, true}
    }, "Square 3x3");

    /** L-shape: top-left corner (3 rows, 2 cols) */
    public static final Block L_SHAPE = new Block(new boolean[][]{
            {true, false},
            {true, false},
            {true, true}
    }, "L-Shape");

    /** J-shape: top-right corner (mirror of L) */
    public static final Block J_SHAPE = new Block(new boolean[][]{
            {false, true},
            {false, true},
            {true, true}
    }, "J-Shape");

    /** T-shape: T-block pointing down */
    public static final Block T_SHAPE = new Block(new boolean[][]{
            {true, true, true},
            {false, true, false}
    }, "T-Shape");

    /** S-shape: S-block */
    public static final Block S_SHAPE = new Block(new boolean[][]{
            {false, true, true},
            {true, true, false}
    }, "S-Shape");

    /** Z-shape: Z-block (mirror of S) */
    public static final Block Z_SHAPE = new Block(new boolean[][]{
            {true, true, false},
            {false, true, true}
    }, "Z-Shape");

    /** Plus shape: cross of 5 cells */
    public static final Block PLUS = new Block(new boolean[][]{
            {false, true, false},
            {true, true, true},
            {false, true, false}
    }, "Plus");

    /**
     * Returns a list of all defined block types.
     * Used by the game engine to randomly select blocks for each turn.
     * 
     * @return List of all available Block instances
     */
    public static List<Block> getAllBlocks() {
        List<Block> blocks = new ArrayList<>();
        // Add each static block definition to the list
        blocks.add(SINGLE);
        blocks.add(HORIZONTAL_2);
        blocks.add(VERTICAL_2);
        blocks.add(HORIZONTAL_3);
        blocks.add(VERTICAL_3);
        blocks.add(HORIZONTAL_4);
        blocks.add(VERTICAL_4);
        blocks.add(HORIZONTAL_5);
        blocks.add(VERTICAL_5);
        blocks.add(SQUARE_2X2);
        blocks.add(SQUARE_3X3);
        blocks.add(L_SHAPE);
        blocks.add(J_SHAPE);
        blocks.add(T_SHAPE);
        blocks.add(S_SHAPE);
        blocks.add(Z_SHAPE);
        blocks.add(PLUS);
        return blocks;
    }
}
