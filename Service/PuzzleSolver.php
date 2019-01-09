<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

class PuzzleSolver
{
    /**
     * @param Puzzle $puzzle
     * @param Piece[] $remainingPieces
     * @return string
     */
    public function solve(Puzzle $puzzle, array $remainingPieces)
    {

        if (!$puzzle->isRunning()) {
            return;
        }

        if (count($remainingPieces) === 0) {
            $this->addSolution(
                $puzzle->getSolutions(),
                $puzzle->getTestingBoard()
            );
            return;
        }
//        minPieceSize : = minPieceSize(remainingPieces)
//
//	// loops over the remaining pieces
//	for _, piece := range remainingPieces {
//
//        // considers all possible rotations of this piece
//        for _, rot := range piece . Rotations {
//
//            // tries every cell of the grid (limited to the positions where
//            // the piece is not outside the boundaries of the frame)
//            for j := 0;
//                j <= len(puzzle . WorkingGrid[0]) - len(rot[0]);
//                j++ {
//                    for i := 0;
//                        i <= len(puzzle . WorkingGrid) - len(rot);
//                        i++ {
//
//                            actualStates++
//
//					// if the cell is empty and the piece doesn't overlap with other pieces
//					if puzzle . WorkingGrid[i][j] == EMPTY && pieceFits(rot, i, j, puzzle . WorkingGrid){
//
//                            // adds the piece to the grid
//                        updatedGrid := addShapeToGrid(rot, i, j, puzzle . WorkingGrid, piece . Number)
//
//						// checks for already visited states
//						if checkAndUpdateVisitedState(updatedGrid){
//							continue
//						}
//
//						// if the piece doesn't leave any unfillable cell
//						if !hasLeftUnfillableAreas(updatedGrid, minPieceSize){
//
//                            // updates the remaining pieces
//                        index, remainingPieces := removePieceFromRemaining(remainingPieces, piece)
//
//							// recursively calls this function
//							puzzle . WorkingGrid = updatedGrid
//							solvePuzzle(puzzle, remainingPieces)
//
//							// after having tried, remove this piece and goes on
//							updatedGrid = removeShapeFromGrid(updatedGrid, piece . Number)
//							puzzle . WorkingGrid = updatedGrid
//							remainingPieces = append(remainingPieces[:index], append([]Piece{
//                            piece}, remainingPieces[index:]...)...)
//						}
//					}
//				}
//			}
//		}
//	}
//}
    }

}