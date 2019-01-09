<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

class NonValidPieceException extends Exception
{
    public function __construct($message = "The piece is not valid.")
    {
        parent::__construct($message);
    }
}