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
     * @param Board $board
     * @return UnsolvablePuzzle
     */
    public static function createEmpty(Board $board)
    {
        return new static([], $board);
    }

//    /**
//     * @return Condition
//     */
//    public function getCurrentCondition(): Condition
//    {
//        return Condition::create(Piece::OUTER_SIDE_PART, Piece::OUTER_SIDE_PART, Piece::OUTER_SIDE_PART, Piece::OUTER_SIDE_PART);
//    }
}