<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace Application\Service;

use Model\PiecesBag;
use Model\Puzzle;
use Model\UnsolvablePuzzle;

class PuzzleSolver
{
    /**
     * @param Puzzle $puzzle
     * @param PiecesBag $piecesBag
     * @return Puzzle|UnsolvablePuzzle
     */
    public function solve(Puzzle $puzzle, PiecesBag $piecesBag)
    {
        if (count($piecesBag->getRemainingPieces()) === 0 || $puzzle instanceof UnsolvablePuzzle) {
            return $puzzle;
        }

        $candidates = (new MatchFinder())->findValidCandidates(
            $piecesBag->getRemainingPieces(),
            $puzzle->getCurrentCondition()
        );

        foreach ($candidates as $piece) {
            $puzzle = $this->solve(
                $puzzle->placePiece($piece),
                $piecesBag->remove($piece)
            );

            if (!$puzzle instanceof UnsolvablePuzzle) {
                yield $puzzle;
            }
        }
        return UnsolvablePuzzle::create();
    }

}