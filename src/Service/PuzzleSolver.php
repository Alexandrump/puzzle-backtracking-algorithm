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
    public function solve(Puzzle $puzzle, PiecesBag $piecesBag, $iteration = 0): Puzzle
    {
        $iteration++;


        if (count($piecesBag->getRemainingPieces()) === 0 || $puzzle instanceof UnsolvablePuzzle) {
            echo "Final iteration done!.\n\n";
            return $puzzle;
        }

        $candidates = $this->matchFinder->findValidCandidates(
            $piecesBag->getRemainingPieces(),
            $puzzle->getCurrentCondition()
        );


        foreach ($candidates as $k => $piece) {
            file_put_contents('/var/www/html/puzzle/results.txt', $puzzle->placePiece($piece) . "--- ($piece) ----- Candidates:" . $k . "\n\n", FILE_APPEND);
            /** @var Puzzle $puzzle */
            $puzzleAttempt = $this->solve(
                $puzzle->placePiece($piece),
                $piecesBag->remove($piece),
                $iteration + 1
            );

            if (!$puzzleAttempt instanceof UnsolvablePuzzle) {
                return $puzzleAttempt;
            }

        }

        echo "Partial iteration done! Using:" . round((memory_get_usage() / 1048576), 2) . " MB \n";

        echo "-- Pieces Inside the Bag: " . count($piecesBag->getRemainingPieces()) . '. Placed Pieces: ' . $puzzle->totalPlacedPieces() . "\n";

        echo "Iteration: $iteration \n Piece";

        return UnsolvablePuzzle::createEmpty($puzzle->getBoard());
    }
}