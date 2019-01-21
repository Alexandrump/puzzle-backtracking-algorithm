<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 15/01/19
 * Time: 15:42
 */

namespace TalentedPanda\PuzzleProblem\Controller;

use TalentedPanda\PuzzleProblem\Model\Condition;
use TalentedPanda\PuzzleProblem\Model\Puzzle;
use TalentedPanda\PuzzleProblem\Model\PuzzleInputDTO;
use TalentedPanda\PuzzleProblem\Service\MatchFinder;
use TalentedPanda\PuzzleProblem\Service\PuzzleSolver;

class PuzzleController
{
    /** @var MatchFinder */
    private $matchFinder;
    /** @var PuzzleSolver */
    private $puzzleSolver;

    /**
     * PuzzleController constructor.
     * @param MatchFinder $matchFinder
     * @param PuzzleSolver $puzzleSolver
     */
    public function __construct(MatchFinder $matchFinder, PuzzleSolver $puzzleSolver)
    {
        $this->matchFinder = $matchFinder;
        $this->puzzleSolver = $puzzleSolver;
    }

    /**
     * @param PuzzleInputDTO $input
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonExistentPieceException
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException
     */
    public function solvePuzzleFromInputAction(PuzzleInputDTO $input): void
    {

        $firstPiece = $this->matchFinder->findOneCandidate(
            $input->getPiecesBag()->getRemainingPieces(),
            Condition::createDefaultInitial()
        );
        $piecesBag = $input->getPiecesBag()->remove($firstPiece);

        print_r("Solving the puzzle...please be patient. \n");

        $puzzle = Puzzle::createFromCorner(
            $firstPiece,
            $input->getBoard(),
            Condition::createDefaultInitial()
        );

        $solution = $this->puzzleSolver->solve($puzzle, $piecesBag);

        /** @var Puzzle $puzzleSolution */
        foreach ($this->puzzleSolver->solve($puzzle, $input->getPiecesBag()) as $puzzleSolution) {
            print_r("One solution for the puzzle inside the file is: \n");
            print_r($puzzleSolution . "\n\n");
        }
    }
}