<?php
/**
 * User: Alejandro Martínez Peregrina
 * Date: 15/01/19
 * Time: 15:42
 */

namespace TalentedPanda\PuzzleProblem\Controller;

use TalentedPanda\PuzzleProblem\Handler\PuzzleSolutionCommand;
use TalentedPanda\PuzzleProblem\Handler\PuzzleSolutionHandler;
use TalentedPanda\PuzzleProblem\Model\Condition;
use TalentedPanda\PuzzleProblem\Model\Piece;
use TalentedPanda\PuzzleProblem\Model\PuzzleInputDTO;
use TalentedPanda\PuzzleProblem\Service\FileManager;
use TalentedPanda\PuzzleProblem\Service\MatchFinder;
use TalentedPanda\PuzzleProblem\Service\SolutionsCLIPresenter;

class PuzzleController
{
    /** @var MatchFinder */
    private $matchFinder;
    /** @var PuzzleSolutionHandler */
    private $puzzleSolutionHandler;
    /** @var FileManager */
    private $fileManager;
    /** @var SolutionsCLIPresenter */
    private $solutionsCLIPresenter;

    /**
     * PuzzleController constructor.
     * @param MatchFinder $matchFinder
     * @param PuzzleSolutionHandler $puzzleSolutionHandler
     * @param FileManager $fileManager
     * @param SolutionsCLIPresenter $solutionsCLIPresenter
     */
    public function __construct(MatchFinder $matchFinder, PuzzleSolutionHandler $puzzleSolutionHandler, FileManager $fileManager, SolutionsCLIPresenter $solutionsCLIPresenter)
    {
        $this->matchFinder = $matchFinder;
        $this->puzzleSolutionHandler = $puzzleSolutionHandler;
        $this->fileManager = $fileManager;
        $this->solutionsCLIPresenter = $solutionsCLIPresenter;
    }

    /**
     * @param PuzzleInputDTO $input
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonExistentPieceException
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException
     * @throws \Exception
     */
    public function solvePuzzleFromInputAction(PuzzleInputDTO $input): void
    {
        $firstPiece = $this->chooseFirstPiece($input);

        $this->puzzleSolutionHandler->handle(
            PuzzleSolutionCommand::create(
                $firstPiece,
                $input->getPiecesBag()->remove($firstPiece),
                $this->chooseInitialCondition($input, $firstPiece),
                $input->getBoard()
            )
        );

        $this->solutionsCLIPresenter->render(
            $this->fileManager->readSolutions(),
            $input->getBoard()
        );
    }

    /**
     * @param PuzzleInputDTO $input
     * @return Piece
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonExistentPieceException
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException
     */
    private function chooseFirstPiece(PuzzleInputDTO $input): Piece
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
    private function chooseInitialCondition(PuzzleInputDTO $input, Piece $firstPiece): Condition
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