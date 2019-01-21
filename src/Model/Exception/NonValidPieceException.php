<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 8/01/19
 * Time: 17:24
 */

namespace TalentedPanda\PuzzleProblem\Model\Exception;

class NonValidPieceException extends \Exception
{

    /**
     * NonValidPieceException constructor.
     * @param string $message
     */
    public function __construct($message = 'The piece is not valid.')
    {
        parent::__construct($message);
    }

    /**
     * @param int $piecePosition
     * @return NonValidPieceException
     */
    public static function createWithLocated($piecePosition): NonValidPieceException
    {
        return new static("The piece number $piecePosition in the Piece Bag is not valid.");
    }

}