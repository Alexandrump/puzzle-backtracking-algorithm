<?php
/**
 * User: Alejandro Martínez Peregrina
 * Date: 9/01/19
 * Time: 17:05
 */

namespace TalentedPanda\PuzzleProblem\Model;

class UnsolvablePuzzle extends Puzzle
{
    /**
     * UnsolvablePuzzle constructor.
     * @param $pieces
     * @param $board
     */
    private function __construct($pieces, $board)
    {
        parent::__construct($pieces, $board);
    }

    /**
     * @param Board $board
     * @return UnsolvablePuzzle
     */
    public static function createEmpty(Board $board): UnsolvablePuzzle
    {
        return new static([], $board);
    }

}