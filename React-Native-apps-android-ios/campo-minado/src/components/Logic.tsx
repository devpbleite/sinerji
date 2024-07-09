function createBoard(rows: number, columns: number) {
  return Array(rows)
    .fill(0)
    .map((_, row) => {
      return Array(columns)
        .fill(0)
        .map((_, column) => {
          return {
            row,
            column,
            opened: false,
            flagged: false,
            mined: false,
            exploded: false,
            nearMines: 0,
          };
        });
    });
}

const spreadMines = (board: any, minesAmount: number) => {
  const rows = board.length;
  const columns = board[0].length;
  let minesPlanted = 0;

  while (minesPlanted < minesAmount) {
    const rowSel = Math.floor(Math.random() * rows);
    const columnSel = Math.floor(Math.random() * columns);

    if (!board[rowSel][columnSel].mined) {
      board[rowSel][columnSel].mined = true;
      minesPlanted++;
    }
  }
};

const createMinedBoard = (
  rows: number,
  columns: number,
  minesAmount: number
) => {
  const board = createBoard(rows, columns);
  spreadMines(board, minesAmount);
  return board;
};

function cloneBoard(board: any) {
  return board.map((row: any) => {
    return row.map((field: any) => {
      return { ...field };
    });
  });
}

function getNeighbors(board: any, row: number, column: number) {
  const neighbors: any = [];
  const rows = [row - 1, row, row + 1];
  const columns = [column - 1, column, column + 1];
  rows.forEach((r) => {
    columns.forEach((c) => {
      const different = r !== row || c !== column;
      const validRow = r >= 0 && r < board.length;
      const validColumn = c >= 0 && c < board[0].length;
      if (different && validRow && validColumn) {
        neighbors.push(board[r][c]);
      }
    });
  });

  return neighbors;
}

function safeNeighbors(board: any, row: number, column: number) {
  return getNeighbors(board, row, column).every((neighbor) => !neighbor.mined);
}

function openField(board: any, row: number, column: number) {
  const field = board[row][column];
  if (!field.opened) {
    field.opened = true;
    if (field.mined) {
      field.exploded = true;
    } else if (safeNeighbors(board, row, column)) {
      getNeighbors(board, row, column).forEach((neighbor) =>
        openField(board, neighbor.row, neighbor.column)
      );
    } else {
      const neighbors = getNeighbors(board, row, column);
      field.nearMines = neighbors.filter((n) => n.mined).length;
    }
  }
}

function fields(board: any) {
  return [].concat(...board);
}

function hadExplosion(board: any) {
  return fields(board).some((field) => field.exploded);
}

function pendding(board: any) {
  return fields(board).filter(
    (field) =>
      (field.mined && !field.flagged) || (!field.mined && !field.opened)
  ).length;
}

function wonGame(board: any) {
  return (
    fields(board).filter((field) => field.mined && field.opened).length === 0
  );
}

function showMines(board: any) {
  fields(board).forEach((field) => {
    if (field.mined) field.opened = true;
  });
}

export {
  createMinedBoard,
  cloneBoard,
  openField,
  hadExplosion,
  pendding,
  wonGame,
  showMines,
};
