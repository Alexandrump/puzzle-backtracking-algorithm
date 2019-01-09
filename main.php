<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

print_r("Welcome to the Puzzle Solver Application \n");

print_r("Please, write the name of the file to solve (including path): ");

$line = trim(fgets(STDIN));

print_r("Working on the solution...please be patient \n");

//$puzzleSolved = (new PuzzleSolver())->solve();

print_r("The solution for the puzzle inside the file " . $line . "\n" . "" . "\n" . " is:");

//print_r($puzzleSolved);