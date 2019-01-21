<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */
require __DIR__ . '/init.php';

use TalentedPanda\PuzzleProblem\DependencyInjection\ContainerLoader;
use TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException;
use TalentedPanda\PuzzleProblem\Model\Exception\NonValidPiecesBagException;

try {
    printf("Welcome to the Puzzle Solver Application, made using blacktrack algorithm. \n");
    printf("Please, write the name of the file to solve the puzzle:");


//    $fileName = trim(fgets(STDIN));

    $fileName = "2x2.txt";

    $input = (ContainerLoader::instance()->get(
        'talented_panda.puzzle_problem.service.input_handler'
    )->handle($fileName));

    ob_start();
    ob_clean();
    $response = ContainerLoader::instance()->get(
        'talented_panda.puzzle_problem.controller.puzzle'
    )->solvePuzzleFromInputAction($input);
    ob_flush();

} catch (NonValidFilePathException $nonValidFilePathException) {
    printf($nonValidFilePathException->getMessage());
    exit;
} catch (NonValidPiecesBagException $nonValidPiecesBagException) {
    print_r($nonValidPiecesBagException->getMessage() . "\n");
    exit;
} catch (Exception $exception) {
    echo get_class($exception) . ':  ' . $exception->getMessage();
    printf("\n\nAn error was occurred while trying to load any service.");
    exit;
}
