<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

class Board
{
    /** @var int */
    private $width;

    /** @var int */
    private $height;


    public function __construct($dimension)
    {
        $this->width = explode(" ", $dimension)[0];
        $this->height = explode(" ", $dimension)[1];
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }


}