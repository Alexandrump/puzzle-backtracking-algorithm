<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

class Puzzle
{
    /** @var Piece[] */
    private $pieces;

    /** @var Board */
    private $board;

    /** @var Board */
    private $testingBoard;

    /** @var int */
    private $maxPieceSide;

    /** @var int */
    private $minPieceSize;

    /** @var Board[] */
    private $solutions;

    /** @var bool */
    private $isRunning;

    /**
     * Puzzle constructor.
     * @param array $pieces
     * @param Board $board
     * @param Board $testingBoard
     * @param int $maxPieceSide
     * @param int $minPieceSize
     * @param array $solutions
     * @param bool $isRunning
     */
    public function __construct(
        array $pieces,
        Board $board,
        Board $testingBoard,
        int $maxPieceSide,
        int $minPieceSize,
        array $solutions,
        bool $isRunning
    )
    {
        $this->pieces = $pieces;
        $this->board = $board;
        $this->testingBoard = $testingBoard;
        $this->maxPieceSide = $maxPieceSide;
        $this->minPieceSize = $minPieceSize;
        $this->solutions = $solutions;
        $this->isRunning = $isRunning;
    }

    /**
     * @return Piece[]
     */
    public function getPieces(): array
    {
        return $this->pieces;
    }

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * @return Board
     */
    public function getTestingBoard(): Board
    {
        return $this->testingBoard;
    }

    /**
     * @return int
     */
    public function getMaxPieceSide(): int
    {
        return $this->maxPieceSide;
    }

    /**
     * @return int
     */
    public function getMinPieceSize(): int
    {
        return $this->minPieceSize;
    }

    /**
     * @return Board[]
     */
    public function getSolutions(): array
    {
        return $this->solutions;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->isRunning;
    }

}