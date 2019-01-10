<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace Application\Service;

class PuzzleSolver
{
    /**
     * @param Puzzle $puzzle
     * @param PiecesBag $piecesBag
     * @param Puzzle|null $alreadyFoundSolution
     * @return Puzzle|UnsolvablePuzzle
     */
    public function solve(Puzzle $puzzle, PiecesBag $piecesBag, Puzzle $alreadyFoundSolution = null)
    {
        if (count($piecesBag->getRemainingPieces()) === 0 || $puzzle instanceof UnsolvablePuzzle) {
            return $puzzle;
        }

        foreach ($piecesBag->getRemainingPieces() as $piece) {
            $puzzle = $this->solve(
                $puzzle->placePiece($piece),
                $piecesBag->remove($piece)
            );

            if (!$puzzle instanceof UnsolvablePuzzle) {
                return $puzzle;
            }
        }
        return UnsolvablePuzzle::create();
    }

}