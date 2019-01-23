<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 23/01/19
 * Time: 8:49
 */

namespace TalentedPanda\PuzzleProblem\Handler;

use TalentedPanda\PuzzleProblem\Model\Puzzle;
use TalentedPanda\PuzzleProblem\Service\FileManager;
use TalentedPanda\PuzzleProblem\Service\PuzzleSolver;

class PuzzleSolutionHandler
{
    /** @var PuzzleSolver */
    private $puzzleSolver;
    /** @var FileManager */
    private $fileManager;

    /**
     * PuzzleSolutionHandler constructor.
     * @param PuzzleSolver $puzzleSolver
     * @param FileManager $fileManager
     */
    public function __construct(PuzzleSolver $puzzleSolver, FileManager $fileManager)
    {
        $this->puzzleSolver = $puzzleSolver;
        $this->fileManager = $fileManager;
    }

    /**
     * @param PuzzleSolutionCommand $puzzleSolutionCommand
     * @throws \Exception
     */
    public function handle(PuzzleSolutionCommand $puzzleSolutionCommand)
    {
        $puzzle = Puzzle::createFromCorner(
            $puzzleSolutionCommand->getFirstPiece(),
            $puzzleSolutionCommand->getBoard(),
            $puzzleSolutionCommand->getInitialCondition()
        );

        $this->puzzleSolver->solve($puzzle, $puzzleSolutionCommand->getPiecesBag());
    }
}