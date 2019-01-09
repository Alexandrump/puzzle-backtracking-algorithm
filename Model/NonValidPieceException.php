<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 8/01/19
 * Time: 17:24
 */

class NonValidPieceException extends Exception
{

    /**
     * NonValidPieceException constructor.
     */
    public function __construct($message = 'The piece is not valid.')
    {
    }

}