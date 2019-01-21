<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace TalentedPanda\PuzzleProblem\Service;

use TalentedPanda\PuzzleProblem\Model\PiecesBag;
use TalentedPanda\PuzzleProblem\Model\Puzzle;
use TalentedPanda\PuzzleProblem\Model\UnsolvablePuzzle;

class PuzzleSolver
{
    /** @var MatchFinder */
    private $matchFinder;

    /**
     * PuzzleSolver constructor.
     * @param MatchFinder $matchFinder
     */
    public function __construct(MatchFinder $matchFinder)
    {
        $this->matchFinder = $matchFinder;
    }

    /**
     * @param Puzzle $puzzle
     * @param PiecesBag $piecesBag
     * @return \Generator
     */
    public function solve(Puzzle $puzzle, PiecesBag $piecesBag): Puzzle
    {
        if (count($piecesBag->getRemainingPieces()) === 0 || $puzzle instanceof UnsolvablePuzzle) {
            echo "Final iteration done!.\n\n";
            return $puzzle;
        }

        $candidates = $this->matchFinder->findValidCandidates(
            $piecesBag->getRemainingPieces(),
            $puzzle->getCurrentCondition()
        );

        foreach ($candidates as $piece) {
            /** @var Puzzle $puzzle */
            $puzzleAttempt = $this->solve(
                $puzzle->placePiece($piece),
                $piecesBag->remove($piece)
            );

            if (!$puzzleAttempt instanceof UnsolvablePuzzle) {
                return $puzzleAttempt;
            }
        }
        echo "Partial iteration done!.\n";
        return UnsolvablePuzzle::createEmpty($puzzle->getBoard());
    }

}