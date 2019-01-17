<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace TalentedPanda\PuzzleProblem\Model;

class Board
{
    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /** @var int */
    private $totalNumberOfPieces;

    /**
     * Board constructor.
     * @param string $width
     * @param string $height
     */
    public function __construct(string $width, string $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->totalNumberOfPieces = $width * $height;
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

    /**
     * @return int
     */
    public function getTotalNumberOfPieces(): int
    {
        return $this->totalNumberOfPieces;
    }


}