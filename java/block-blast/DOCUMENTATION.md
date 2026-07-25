# Block Blast — Java Swing Clone Documentation

## Table of Contents
1. [Project Setup & Environment Guide](#project-setup--environment-guide)
2. [System Architecture](#system-architecture)
3. [OOP Concepts Applied](#oop-concepts-applied)
4. [Class Descriptions](#class-descriptions)
5. [Drag-and-Drop System](#drag-and-drop-system)
6. [Game Flow](#game-flow)
7. [Scoring System](#scoring-system)
8. [Building & Running](#building--running)

---

## Project Setup & Environment Guide

### Prerequisites
- **Java JDK 8** or higher (recommended: JDK 17+)
- **IDE**: IntelliJ IDEA, Eclipse, or VS Code with Java extensions
- **No external libraries** — uses only Java Swing (bundled with JDK)

### Folder Structure
```
block-blast/
├── src/
│   └── blockblast/
│       ├── BlockBlastGame.java          # Main entry point
│       ├── model/
│       │   ├── Board.java               # 8x8 grid state management
│       │   ├── Block.java               # Block shape definitions
│       │   └── GameEngine.java          # Game logic, scoring, turns
│       ├── view/
│       │   ├── BoardPanel.java          # Board rendering (JPanel)
│       │   ├── BlockPiecePanel.java     # Individual block piece rendering
│       │   └── GameFrame.java           # Main window, layout, drag-drop
│       └── controller/
│           └── GameController.java      # Mediates model ↔ view
├── out/                                  # Compiled .class files
└── DOCUMENTATION.md                      # This file
```

### Compiling & Running
```bash
# From the project root (block-blast/)
# Compile all source files
javac -d out \
  src/blockblast/model/*.java \
  src/blockblast/view/*.java \
  src/blockblast/controller/*.java \
  src/blockblast/BlockBlastGame.java

# Run the game
java -cp out blockblast.BlockBlastGame
```

---

## System Architecture

### MVC (Model-View-Controller) Pattern

```
┌──────────────────────────────────────────────────────────────┐
│                        MVC Architecture                       │
├──────────────┬──────────────────────┬────────────────────────┤
│     MODEL    │        VIEW          │      CONTROLLER        │
├──────────────┼──────────────────────┼────────────────────────┤
│ Board.java   │ BoardPanel.java      │ GameController.java    │
│ Block.java   │ BlockPiecePanel.java │                        │
│ GameEngine   │ GameFrame.java       │                        │
├──────────────┼──────────────────────┼────────────────────────┤
│ Grid state   │ Renders the board    │ Handles user input     │
│ Block shapes │ Renders block pieces │ Forwards to engine     │
│ Game logic   │ Score display        │ Validates placement    │
│ Scoring      │ Glass pane drag-drop │ Returns results        │
└──────────────┴──────────────────────┴────────────────────────┘
```

### Data Flow
```
User Click on Block Piece
       │
       ▼
Glass Pane (dragGlassPane) ──── mousePressed → findBlockPieceAt()
       │
       ├── dragging = true
       ├── dragBlock = engine.getCurrentBlocks().get(index)
       └── blockPanels[i].setSelected(true)

User Moves Mouse (while holding)
       │
       ▼
Glass Pane ──── mouseDragged
       ├── Update dragMouseX, dragMouseY (screen coords)
       ├── SwingUtilities.convertPoint → boardPanel local coords
       ├── engine.canPlaceAt() → validate placement
       ├── boardPanel.setGhostBlock() + setGhostPosition()
       └── glassPane.repaint() → renders floating block at cursor

User Releases Mouse
       │
       ▼
Glass Pane ──── mouseReleased
       ├── SwingUtilities.convertPoint → boardPanel local coords
       ├── boardPanel.pixelToRow/Col → grid row, col
       ├── controller.handleBlockPlacement(index, row, col)
       │   └── GameEngine.placeBlock()
       │       ├── Board.placeBlock() → modify grid[][]
       │       ├── Board.clearFullLines() → simultaneous row/col clearing
       │       └── Calculate score + combos
       ├── boardPanel.clearGhost()
       ├── blockPanels[i].setPlaced(true)
       ├── refreshBlockPanels() → rebuild bottom panel
       └── Check game-over → showGameOver()
```

---

## OOP Concepts Applied

### 1. Encapsulation

| Class | Private Fields | Public Methods | Purpose |
|-------|---------------|----------------|---------|
| `Board` | `grid[][]`, `gridColor[][]` | `isOccupied()`, `placeBlock()`, `canPlace()`, `clearFullLines()` | Hides internal grid state; only exposes safe operations |
| `Block` | `shape[][]`, `rows`, `cols`, `name` | `isFilled()`, `getRows()`, `getCols()`, `getCellCount()` | Immutable shape definition; no external modification possible |
| `GameEngine` | `board`, `score`, `gameOver`, `currentBlocks` | `placeBlock()`, `getScore()`, `isGameOver()` | Centralizes all game state; controlled access through getters |
| `BlockPiecePanel` | `block`, `blockColor`, `placed`, `selected` | `setPlaced()`, `setSelected()`, `isPlaced()`, `isSelected()` | Encapsulates rendering state of a single block piece |
| `BoardPanel` | `board`, `ghostBlock`, `ghostColor`, `ghostRow/Col` | `setBoard()`, `setGhostBlock()`, `setGhostPosition()`, `clearGhost()` | Hides ghost preview state; controlled access for drag feedback |

**Key Example — Board Encapsulation:**
```java
// PRIVATE: internal state is hidden
private final boolean[][] grid;

// PUBLIC: controlled access with bounds checking
public boolean isOccupied(int row, int col) {
    if (row < 0 || row >= ROWS || col < 0 || col >= COLS) {
        return true; // Out-of-bounds treated as occupied
    }
    return grid[row][col];
}
```

### 2. Abstraction

| Class | Abstracted Concept | Hidden Complexity |
|-------|-------------------|-------------------|
| `Board` | Grid management | 2D array manipulation, simultaneous line-clearing algorithm |
| `GameEngine` | Game rules | Turn management, combo calculation, game-over detection |
| `GameFrame` | User interaction | Glass pane drag-drop, coordinate conversion, ghost preview |
| `GameController` | Input handling | Delegates to engine, returns simple boolean results |

### 3. Inheritance

| Relationship | Parent | Child | Override |
|-------------|--------|-------|----------|
| `BoardPanel extends JPanel` | `JPanel` | `BoardPanel` | `paintComponent(Graphics g)` — renders grid, cells, ghost |
| `BlockPiecePanel extends JPanel` | `JPanel` | `BlockPiecePanel` | `paintComponent(Graphics g)` — renders block shape with selection state |
| `GameFrame extends JFrame` | `JFrame` | `GameFrame` | Adds glass pane drag-drop, layout, game-over overlay |
| Anonymous `JPanel` in `setupGlassPane` | `JPanel` | anonymous | `paintComponent(Graphics g)` — renders floating block during drag |

### 4. Polymorphism

**Method Overriding (Runtime):**
- `paintComponent()` overridden in `BoardPanel`, `BlockPiecePanel`, and the anonymous glass pane — same method, different rendering
- `MouseAdapter` methods overridden in anonymous inner classes for each event type

**Method Overloading (Compile-time):**
- `Board.canPlace(Block, int, int)` — read-only validation
- `Board.placeBlock(Block, int, int, Color)` — executes placement + returns success

### 5. Composition

```
GameFrame ────── HAS-A ────── BoardPanel
           ────── HAS-A ────── BlockPiecePanel[3]
           ────── HAS-A ────── GameController
           ────── HAS-A ────── JPanel (dragGlassPane — anonymous subclass)

GameEngine ───── HAS-A ────── Board
             ───── HAS-A ────── List<Block> (currentBlocks)
             ───── HAS-A ────── List<Color> (currentColors)

Board ────────── HAS-A ────── boolean[][] grid
          ────── HAS-A ────── Color[][] gridColor
```

### 6. Single Responsibility Principle (SRP)

| Class | Responsibility |
|-------|---------------|
| `Board` | Grid state and line-clearing logic ONLY |
| `Block` | Block shape definitions and cell queries ONLY |
| `GameEngine` | Game rules, scoring, and turn management ONLY |
| `BoardPanel` | Rendering the 8x8 grid and ghost preview ONLY |
| `BlockPiecePanel` | Rendering a single block piece with selection state ONLY |
| `GameFrame` | Window layout, glass pane drag-drop, and event coordination ONLY |
| `GameController` | Mediating user input to game logic ONLY |

---

## Class Descriptions

### Model Layer

#### `Board.java`
The core 8x8 grid. Uses a `boolean[][]` for occupancy tracking and `Color[][]` for rendering colors.

**Key Methods:**
- `placeBlock(Block, row, col, Color)` — Validates and places a block on the grid
- `canPlace(Block, row, col)` — Read-only placement validation (no side effects)
- `clearFullLines()` — **Simultaneous** row AND column clearing algorithm
- `getOccupiedCellCount()` / `getEmptyCellCount()` — Cell counting utilities

**Line-Clearing Algorithm (The Core Mechanic):**
```
Phase 1: Scan all 8 rows → mark fully filled rows in boolean[] fullRows
Phase 2: Scan all 8 columns → mark fully filled columns in boolean[] fullCols
Phase 3: Clear ALL marked rows AND columns simultaneously (not sequentially)
Phase 4: Return total lines cleared (rows + columns) for scoring
```

#### `Block.java`
Immutable block shape definitions. 17 block types defined as static final constants.

**Block Types:**
- Single (1×1)
- Lines: Horizontal/Vertical 2, 3, 4, 5
- Squares: 2×2, 3×3
- L-shapes: L, J (mirrored L)
- T-shape, S-shape, Z-shape
- Plus (+) shape

**Key Design:** Shape matrix is deep-copied in constructor to prevent external modification (defensive copy pattern).

#### `GameEngine.java`
The game logic controller. Manages turns, scoring, and game-over detection.

**Key Methods:**
- `startNewGame()` — Resets all state and generates first turn
- `generateNewTurn()` — Creates 3 random blocks, checks game-over
- `placeBlock(blockIndex, row, col)` — Full placement pipeline (validate → place → clear → score → turn management)
- `canPlaceAt(blockIndex, row, col)` — Preview validation (read-only)

---

### View Layer

#### `BoardPanel.java`
Custom `JPanel` that renders the 8x8 grid with cell coloring and ghost preview.

**Key Features:**
- 50×50 pixel cells with 10px padding
- Ghost/semi-transparent preview during drag (green = valid, red = invalid)
- 3D effect on occupied cells (highlight on top/left, shadow on bottom/right)
- `pixelToRow()` / `pixelToCol()` — coordinate conversion for drag-drop

**Ghost Preview System:**
- `setGhostBlock(Block, Color)` — stores the actual Block reference (not index)
- `setGhostPosition(row, col, valid)` — sets grid position and validity
- `clearGhost()` — removes preview
- `drawGhostPreview()` — renders semi-transparent overlay using stored Block reference

#### `BlockPiecePanel.java`
Custom `JPanel` that renders a single block shape for selection.

**Key Features:**
- Compact 25×25 cell rendering
- Three visual states: normal, placed (grayed-out), selected (highlighted border)
- 3D cell effects when not placed/selected

**State Management:**
- `setPlaced(boolean)` — marks block as used (grayed out)
- `setSelected(boolean)` — marks block as currently being dragged (white highlight border)

#### `GameFrame.java`
Main application window integrating all view components with glass-pane drag-and-drop.

**Key Features:**
- BorderLayout: top (score bar), center (board), bottom (block pieces)
- Glass pane drag-drop system (see Drag-and-Drop section below)
- Game-over overlay with final score and restart button

---

### Controller Layer

#### `GameController.java`
Lightweight mediator between View and Model. Contains NO GUI code, NO grid logic.

**Key Methods:**
- `handleBlockPlacement(blockIndex, row, col)` → delegates to `engine.placeBlock()`
- `isValidPlacement(blockIndex, row, col)` → delegates to `engine.canPlaceAt()`
- `handleNewGame()` → delegates to `engine.startNewGame()`

---

## Drag-and-Drop System

### The Glass Pane Approach

The drag-and-drop system uses Swing's **glass pane** — a transparent `JPanel` that sits on top of ALL child components in the JFrame.

**Why Glass Pane?**
Standard Swing `mouseMotionListener` only fires on the component the cursor is currently over. When dragging from a block piece panel below the board, the mouse leaves that panel and enters others — motion events are lost.

The glass pane solves this by:
1. Covering the entire JFrame window
2. Receiving ALL mouse events regardless of which child component is underneath
3. Rendering the floating block preview at the cursor position

### Implementation Details

**Glass Pane Setup (`GameFrame.setupGlassPane()`):**
```java
// 1. Create anonymous JPanel subclass with custom paintComponent
dragGlassPane = new JPanel() {
    @Override
    protected void paintComponent(Graphics g) {
        // Renders the floating block at cursor position
        // Uses dragBlock, dragColor, dragMouseX/Y fields
    }
};

// 2. Replace default glass pane
setGlassPane(dragGlassPane);

// 3. Add mouse listeners for drag lifecycle
dragGlassPane.addMouseListener(new MouseAdapter() {
    mousePressed()  → findBlockPieceAt() → start drag
    mouseReleased() → convertPoint to board → place block → end drag
});

dragGlassPane.addMouseMotionListener(new MouseMotionAdapter() {
    mouseDragged() → update position → update ghost preview → repaint
});
```

**Coordinate Conversion Pipeline:**
```
Screen coordinates (e.getXOnScreen(), e.getYOnScreen())
    │
    ▼ SwingUtilities.convertPoint(null, screen, glassPane)
Glass pane local coordinates
    │
    ▼ SwingUtilities.convertPoint(glassPane, point, boardPanel)
Board panel local coordinates
    │
    ▼ boardPanel.pixelToRow(y) / pixelToCol(x)
Grid row/column (0-7)
```

**Visual Feedback During Drag:**
1. **Selected piece** — block piece panel gets white highlight border
2. **Floating block** — rendered on glass pane centered on cursor
3. **Ghost preview** — semi-transparent overlay on board grid (green=valid, red=invalid)
4. **Drop** — block snaps to grid, ghost clears, piece grays out

---

## Game Flow

```
1. Application Start
   └── BlockBlastGame.main()
       └── SwingUtilities.invokeLater()
           ├── Create GameEngine
           ├── Create GameFrame
           │   └── GameFrame constructor
           │       ├── engine.startNewGame()
           │       ├── Build UI (top bar, board, block pieces, overlay)
           │       └── setupGlassPane() → configure drag-drop
           └── frame.setVisible(true)

2. User Clicks Block Piece
   └── Glass Pane mousePressed
       ├── findBlockPieceAt(point) → hit test on blockPanels[0..2]
       ├── dragging = true
       ├── dragBlock = currentBlocks.get(index)
       ├── dragColor = currentColors.get(index)
       └── blockPanels[i].setSelected(true) → white highlight

3. User Moves Mouse (holding button)
   └── Glass Pane mouseDragged
       ├── Update dragMouseX, dragMouseY
       ├── SwingUtilities.convertPoint → boardPanel local coords
       ├── boardPanel.pixelToRow/Col → grid row, col
       ├── engine.canPlaceAt(index, row, col) → valid?
       ├── boardPanel.setGhostBlock(block, color)
       ├── boardPanel.setGhostPosition(row, col, valid)
       └── glassPane.repaint() → floating block follows cursor

4. User Releases Mouse
   └── Glass Pane mouseReleased
       ├── Convert to board local → grid row, col
       ├── controller.handleBlockPlacement(index, row, col)
       │   └── engine.placeBlock()
       │       ├── board.canPlace() → validate
       │       ├── board.placeBlock() → modify grid[][], gridColor[][]
       │       ├── board.clearFullLines() → simultaneous clearing
       │       ├── Calculate score (cells × 10 + combo bonus)
       │       └── Check if turn complete / game over
       ├── blockPanels[i].setPlaced(true) → gray out
       ├── boardPanel.clearGhost()
       ├── dragging = false
       ├── glassPane.repaint() → clear floating block
       ├── updateUI() → score, lines, high score
       ├── refreshBlockPanels() → rebuild bottom panel
       └── if game over → showGameOver()

5. Game Over
   └── showGameOver()
       ├── Display "GAME OVER" + final score
       └── Show "Play Again" button

6. Restart
   └── restartGame()
       ├── engine.startNewGame()
       ├── Hide overlay
       ├── boardPanel.setBoard(engine.getBoard())
       ├── refreshBlockPanels()
       └── updateUI()
```

---

## Scoring System

| Action | Points |
|--------|--------|
| Each block cell placed | 10 points |
| Single line cleared | 10 × 8 = 80 points (8 cells) |
| 2 lines cleared simultaneously | 80 + 80 + 100 = 260 points |
| 3 lines cleared simultaneously | 80×3 + 100×(2+3) = 540 points |
| 4 lines cleared simultaneously | 80×4 + 100×(2+3+4) = 920 points |

**Combo Formula:**
```
turnScore = (cellsCleared × POINTS_PER_CELL)
          + (linesCleared - 1) × COMBO_MULTIPLIER × linesCleared
```
Where:
- `POINTS_PER_CELL = 10`
- `COMBO_MULTIPLIER = 50`
- Lines cleared = rows + columns cleared simultaneously

---

## Building & Running

### Method 1: Command Line
```bash
# Navigate to project root
cd block-blast

# Compile
javac -d out \
  src/blockblast/model/Board.java \
  src/blockblast/model/Block.java \
  src/blockblast/model/GameEngine.java \
  src/blockblast/view/BoardPanel.java \
  src/blockblast/view/BlockPiecePanel.java \
  src/blockblast/view/GameFrame.java \
  src/blockblast/controller/GameController.java \
  src/blockblast/BlockBlastGame.java

# Run
java -cp out blockblast.BlockBlastGame
```

### Method 2: IDE
1. Import the `src/blockblast/` folder as a Java project
2. Set `BlockBlastGame` as the main class
3. Run

### Controls
- **Drag & Drop**: Click a block piece at the bottom → drag onto the 8×8 grid → release to place
- **Ghost Preview**: Semi-transparent overlay shows where the block will land (green = valid, red = invalid)
- **Floating Block**: Block shape follows the cursor centered during drag
- **Selection Highlight**: Block piece shows white border while being dragged
- **Play Again**: Click the button after game over

---

## Game Rules (Block Blast)

1. **8×8 Grid**: The game board is an 8×8 grid
2. **3 Blocks Per Turn**: You receive 3 random block shapes each turn
3. **No Rotation**: Blocks cannot be rotated — place them as given
4. **No Moving**: Once placed, blocks cannot be moved
5. **Line Clearing**: Fill a complete row OR column → it clears and awards points
6. **Simultaneous Clearing**: Rows AND columns are cleared at the same time
7. **Combos**: Clearing multiple lines at once grants bonus points
8. **Game Over**: When none of the remaining blocks can fit anywhere on the board
