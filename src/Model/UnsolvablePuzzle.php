<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
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
     * @return UnsolvablePuzzle
     */
    public static function create()
    {
        return new static([], new Board('0 0'));
    }
}