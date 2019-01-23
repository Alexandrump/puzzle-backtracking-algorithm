<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 16/01/19
 * Time: 10:08
 */

namespace TalentedPanda\PuzzleProblem\Service;


use TalentedPanda\PuzzleProblem\Model\Board;
use TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException;
use TalentedPanda\PuzzleProblem\Model\Exception\NonValidPiecesBagException;
use TalentedPanda\PuzzleProblem\Model\PiecesBag;
use TalentedPanda\PuzzleProblem\Model\PuzzleInputDTO;

class InputHandler
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * @param string $fileName
     * @return PuzzleInputDTO
     * @throws NonValidFilePathException
     * @throws NonValidPiecesBagException
     */
    public function handle(string $fileName): PuzzleInputDTO
    {
        $fileContent = $this->fileManager->readFromPuzzles($fileName);
        $board = $this->buildBoard($fileContent);

        return PuzzleInputDTO::create(
            $fileName,
            $board,
            $this->buildPiecesBag($fileContent, $board->getTotalNumberOfPieces())
        );
    }

    /**
     * @param array $fileContent
     * @return Board
     */
    private function buildBoard(array $fileContent): Board
    {
        $dimension = array_shift($fileContent);

        return new Board(
            explode(" ", $dimension)[0],
            explode(" ", $dimension)[1]
        );
    }

    /**
     * @param array $fileContent
     * @param int $totalNumberOfPieces
     * @return PiecesBag
     * @throws NonValidPiecesBagException
     */
    private function buildPiecesBag(array $fileContent, int $totalNumberOfPieces): PiecesBag
    {
        array_shift($fileContent); //Discard first element

        return PiecesBag::initialize(
            array_filter(
                $fileContent,
                function ($piece) {
                    if (!empty($piece)) {
                        return true;
                    }
                    return false;
                }
            ),
            $totalNumberOfPieces
        );

    }

}