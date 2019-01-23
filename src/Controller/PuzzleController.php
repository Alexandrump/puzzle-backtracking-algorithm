<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 15/01/19
 * Time: 15:42
 */

namespace TalentedPanda\PuzzleProblem\Controller;

use TalentedPanda\PuzzleProblem\Handler\PuzzleSolutionCommand;
use TalentedPanda\PuzzleProblem\Handler\PuzzleSolutionHandler;
use TalentedPanda\PuzzleProblem\Model\Condition;
use TalentedPanda\PuzzleProblem\Model\Piece;
use TalentedPanda\PuzzleProblem\Model\Puzzle;
use TalentedPanda\PuzzleProblem\Model\PuzzleInputDTO;
use TalentedPanda\PuzzleProblem\Service\FileManager;
use TalentedPanda\PuzzleProblem\Service\MatchFinder;
use TalentedPanda\PuzzleProblem\Service\PuzzleSolver;

class PuzzleController
{
    /** @var MatchFinder */
    private $matchFinder;
    /** @var PuzzleSolver */
    private $puzzleSolver;
    /** @var FileManager */
    private $fileManager;
    /** @var PuzzleSolutionHandler */
    private $puzzleSolutionHandler;

    /**
     * PuzzleController constructor.
     * @param MatchFinder $matchFinder
     * @param PuzzleSolver $puzzleSolver
     * @param FileManager $fileManager
     * @param PuzzleSolutionHandler $puzzleSolutionHandler
     */
    public function __construct(MatchFinder $matchFinder, PuzzleSolver $puzzleSolver, FileManager $fileManager, PuzzleSolutionHandler $puzzleSolutionHandler)
    {
        $this->matchFinder = $matchFinder;
        $this->puzzleSolver = $puzzleSolver;
        $this->fileManager = $fileManager;
        $this->puzzleSolutionHandler = $puzzleSolutionHandler;
    }

    /**
     * @param PuzzleInputDTO $input
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonExistentPieceException
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException
     */
    public function solvePuzzleFromInputAction(PuzzleInputDTO $input): void
    {
        print_r("\nSolving the puzzle...please be patient. \n\n");

        $firstPiece = $this->chooseFirstPiece($input);

        $this->puzzleSolutionHandler->handle(
            PuzzleSolutionCommand::create(
                $firstPiece,
                $input->getPiecesBag()->remove($firstPiece),
                $this->chooseInitialCondition($input, $firstPiece),
                $input->getBoard()
            )
        );

        echo "One solution for the puzzle inside the file is: \n";
        $this->fileManager->readFromPublic(
            'Solutions', $input->getFileName() . '_solution_' . date("H_i_s_d_m_Y") . '.' . FileManager::TXT_EXTENSION
        );

        exit;

        /** @var Puzzle $puzzleSolution */
        foreach ($this->puzzleSolver->solve($puzzle, $input->getPiecesBag()) as $puzzleSolution) {
            print_r("One solution for the puzzle inside the file is: \n");
            print_r($puzzleSolution . "\n\n");
        }
    }

    /**
     * @param PuzzleInputDTO $input
     * @return Piece
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonExistentPieceException
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException
     */
    private function chooseFirstPiece(PuzzleInputDTO $input)
    {
        return $this->matchFinder->findOneCandidate(
            $input->getPiecesBag()->getRemainingPieces(),
            Condition::createDefaultInitial()
        );
    }

    /**
     * @param PuzzleInputDTO $input
     * @param Piece $firstPiece
     * @return Condition
     */
    private function chooseInitialCondition(PuzzleInputDTO $input, Piece $firstPiece)
    {
        return $input->getBoard()->getWidth() !== 2 ?
            Condition::create(
                $firstPiece->getSides()[2],
                Piece::OUTER_SIDE_PART
            ) :
            Condition::create(
                $firstPiece->getSides()[2],
                Piece::OUTER_SIDE_PART,
                Piece::OUTER_SIDE_PART
            );
    }
}