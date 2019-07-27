<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 6/02/19
 */

namespace TalentedPanda\PuzzleProblem\Service;

use TalentedPanda\PuzzleProblem\Model\Board;

class SolutionsCLIPresenter
{
    /**
     * @param $solutions
     * @param $board
     */
    public function render($solutions, $board): void
    {
        print_r($this->transform($solutions, $board));
    }

    /**
     * @param $solutions
     * @param Board $board
     * @return string
     */
    private function transform($solutions, Board $board): string
    {
        $puzzles = json_decode($solutions);
        $presentedPuzzles = '';
        foreach ($puzzles as $solutionNumber => $puzzle) {
            $presentedPuzzle = '';

            foreach ($puzzle as $iteration => $piece) {
                if (($iteration + 1) % $board->getWidth() !== 0) {
                    $presentedPuzzle .= ($piece + 1) . " ";
                } else {
                    $presentedPuzzle .= ($piece + 1) . "\n";
                }
            }
            $presentedPuzzles .= "Solution " . ($solutionNumber + 1) . ":\n" . $presentedPuzzle . "\n";
        }

        return $presentedPuzzles;
    }
}