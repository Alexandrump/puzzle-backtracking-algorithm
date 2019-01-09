<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

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
     * @param null $initialState
     */
    public function __construct(
        array $placedPieces,
        Board $board,
        $initialState = null
    )
    {
        $this->placedPieces = $placedPieces;
        $this->board = $board;
        $this->recalculateCondition();
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
     * @return Piece[]
     */
    public function getUsedPieces(): array
    {
        return $this->usedPieces;
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

        if ($piece->meets($condition)) {

        }
    }

    private function recalculateUsedPieces(Piece $piece): array
    {

    }

    toString();
}