<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace Model\Exception;


class NonValidPiecesBagException extends \Exception
{

    /**
     * NonValidPiecesBagException constructor.
     * @param string $message
     */
    public function __construct($message = 'There are less pieces provided for craft the puzzle than required')
    {
        parent::__construct($message);
    }
}