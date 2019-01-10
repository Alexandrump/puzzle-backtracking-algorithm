<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace Model;

class Puzzle
{
    /** @var Piece[] */
    private $placedPieces;

    /** @var Board */
    private $board;

    /** @var Condition */
    private $currentCondition;

    /**
     * Puzzle constructor.
     * @param array $placedPieces
     * @param Board $board
     * @param Condition|null $initialCondition
     */
    public function __construct(
        array $placedPieces,
        Board $board
    )
    {
        $this->placedPieces = $placedPieces;
        $this->board = $board;
        $this->currentCondition = !(empty($initialCondition)) ? $initialCondition : $this->recalculateCondition();
    }

    public static function createFromCorner(
        array $placedPieces,
        Board $board,
        Condition $initialCondition
    )
    {
        $puzzle = new static();
    }

    public static function create()
    {

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
     * @return Condition
     */
    public function getCurrentCondition(): Condition
    {
        return $this->currentCondition;
    }

    /**
     * @param $piece
     * @return Puzzle
     */
    public function placePiece(Piece $piece): Puzzle
    {
        if ($piece->meets($this->getCurrentCondition())
        ) {
            $puzzle = new Puzzle($this->getPieces(), $this->getBoard());

            return $puzzle;
        }
        return UnsolvablePuzzle::create();
    }

    private function recalculateCondition(Piece $piece): Condition
    {
        $condition = ''; //Condicion a satisfacer
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return '';
    }
}