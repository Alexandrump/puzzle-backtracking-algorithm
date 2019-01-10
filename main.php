<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

include 'init.php';

use Application\Service\FileManager;
use Application\Service\MatchFinder;
use Application\Service\PuzzleSolver;
use Model\Board;
use Model\Condition;
use Model\Exception\NonValidPiecesBagException;
use Model\Piece;
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
        $piecesBag = PiecesBag::initialize(
            array_filter(
                $fileContent,
                function ($piece) {
                    if (!empty($piece)) {
                        return $piece;
                    }
                }
            ),
            $board->getTotalNumberOfPieces()
        );
    } catch (NonValidPiecesBagException $nonValidPiecesBagException) {
        printf($nonValidPiecesBagException->getMessage() . "\n");
        exit;
    }

    //Initial piece of the puzzle needs to have two of their sides specials (0)
    $initialCondition = new Condition(
        [
            'left' => 0,
            'top' => 0
        ]
    );

    try {
        /* There should be an instanced MatchFinder here that call method findOneCandidate()
        for the first time I put a piece.    */
        $firstPiece = (new MatchFinder())->findOneCandidate($piecesBag->getRemainingPieces(), $initialCondition);

        $puzzle = Puzzle::createFromCorner(
            $firstPiece,
            $board,
            $initialCondition
        );

        /* Presented only the code being developed to print only the first it find, but in solve() method in PuzzleSolver
        is using Generators (yield instead of return), so what it should to were to iterate, and continu up to
        UnsolvablePuzzle were found, that mean that it have finished of calculate all solutions possible
         */
        $solution = (new PuzzleSolver())->solve($puzzle, $piecesBag);

    } catch (Exception $exception) {
        printf($exception->getMessage());
    }
    printf("Working on the solution...please be patient \n");


    printf("The solution for the puzzle inside the file is:");

    printf($solution);
}