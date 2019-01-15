<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

require __DIR__ . '/init.php';

ob_start();

$response = \TalentedPanda\\DependencyInjection\ContainerLoader::instance()->get(
    'peim.command.tracking_snapshot_report.consejo_gobierno'
)->processExecution();

if (!$response) {
    echo "Error";
    exit;
}

ob_clean();
$response->prepare($request);
$response->send();
ob_flush();

use TalentedPanda\PuzzleProblem\Service\FileManager;
use TalentedPanda\PuzzleProblem\Service\MatchFinder;
use TalentedPanda\PuzzleProblem\Service\PuzzleSolver;
use TalentedPanda\PuzzleProblem\Model\Board;
use TalentedPanda\PuzzleProblem\Model\Condition;
use TalentedPanda\PuzzleProblem\Model\Exception\NonValidPiecesBagException;
use TalentedPanda\PuzzleProblem\Model\Piece;
use TalentedPanda\PuzzleProblem\Model\PiecesBag;
use TalentedPanda\PuzzleProblem\Model\Puzzle;

execute();

function execute()
{
    printf("Welcome to the Puzzle Solver Application, made using blacktrack algorithm. \n");

    printf("Please, write the name of the file to solve (including path from your user folder): " . DIRECTORY_SEPARATOR);

    try {
        $path = trim(fgets(STDIN));

        $fileContent = (new FileManager())->read($path);

        $dimension = array_shift($fileContent);

        $board = new Board(
            explode(" ", $dimension)[0],
            explode(" ", $dimension)[1]
        );

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

        //Initial piece of the puzzle needs to have two of their sides specials (0)
        $initialCondition = new Condition(
            [
                'left' => 0,
                'top' => 0
            ]
        );

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

    } catch (NonValidPiecesBagException $nonValidPiecesBagException) {
        printf($nonValidPiecesBagException->getMessage() . "\n");
        exit;
    } catch (Exception $exception) {
        printf($exception->getMessage());
    }

    printf("Working on the solution...please be patient \n");

    printf("The solution for the puzzle inside the file is:");

    printf($solution);

}