<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

include 'init.php';

use Application\Service\FileManager;
use Application\Service\PuzzleSolver;
use Model\Board;
use Model\Exception\NonValidPiecesBagException;
use Model\PiecesBag;
use Model\Puzzle;

execute();

function execute()
{
    printf("Welcome to the Puzzle Solver Application, made using blacktrack algorithm. \n");

    printf("Please, write the name of the file to solve (including path from your user folder): " . DIRECTORY_SEPARATOR);

    $path = trim(fgets(STDIN));

    $fileContent = (new FileManager())->read($path);

    $dimension = array_shift($fileContent);

    $board = new Board(
        explode(" ", $dimension)[0],
        explode(" ", $dimension)[1]
    );

    try {
        $piecesBag = new PiecesBag(
            array_filter(
                $fileContent,
                function ($piece) {
                    if (!empty($piece)) {
                        return $piece;
                    }
                }
            ),
            $board->getTotalNumberOfPieces(),
            true
        );
    } catch (NonValidPiecesBagException $nonValidPiecesBagException) {
        printf($nonValidPiecesBagException->getMessage() . "\n");
        exit;
    }

    $puzzle = new Puzzle();

    printf("Working on the solution...please be patient \n");

    $solution = (new PuzzleSolver())->solve();

    printf("The solution for the puzzle inside the file " . $line . "\n" . "" . "\n" . " is:");

    printf($solution);
}