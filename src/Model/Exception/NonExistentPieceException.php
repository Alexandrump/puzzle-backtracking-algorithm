<?php
/**
 * User: Alejandro Martínez Peregrina
 * Date: 10/01/19
 * Time: 11:13
 */

namespace TalentedPanda\PuzzleProblem\Model\Exception;


class NonExistentPieceException extends \Exception
{

    /**
     * NonExistentPiece constructor.
     */
    public function __construct()
    {
        return parent::__construct("\nThe content of the file is not valid to solve the puzzle.\n");
    }
}