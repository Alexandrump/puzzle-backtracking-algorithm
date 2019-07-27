<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\Model\Exception;

class NonValidPiecesBagException extends \Exception
{
    /**
     * NonValidPiecesBagException constructor.
     * @param string $message
     */
    public function __construct($message = "\nThere are less pieces provided for craft the puzzle than required\n")
    {
        parent::__construct($message);
    }
}