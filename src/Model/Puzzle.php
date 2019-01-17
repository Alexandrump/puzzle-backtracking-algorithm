<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace TalentedPanda\PuzzleProblem\Model;

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
        $this->board = $board;
        $this->placedPieces = $placedPieces;
    }

    /**
     * @param Piece $initialPiece
     * @param Board $board
     * @param Condition $initialCondition
     * @return Puzzle
     */
    public static function createFromCorner(
        Piece $initialPiece,
        Board $board,
        Condition $initialCondition
    )
    {
        $puzzle = new static([$initialPiece], $board);
        $puzzle->setCurrentCondition($initialCondition);

        return $puzzle;
    }

    /**
     * @param $placedPieces
     * @param $board
     * @return Puzzle
     */
    public static function create($placedPieces, $board)
    {
        $puzzle = new static($placedPieces, $board);
        $puzzle->recalculateCondition();

        return $puzzle;
    }

    /**
     * @return Piece[]
     */
    private function getPieces(): array
    {
        return $this->placedPieces;
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
     * @param Condition $currentCondition
     */
    private function setCurrentCondition(Condition $currentCondition): void
    {
        $this->currentCondition = $currentCondition;
    }

    /**
     * @param $piece
     * @return Puzzle
     */
    public function placePiece(Piece $piece): Puzzle
    {
        if ($piece->meets($this->getCurrentCondition())
        ) {
            $puzzle = Puzzle::create(
                array_merge($this->getPieces(), [$piece]),
                $this->getBoard()
            );

            return $puzzle;
        }
        return UnsolvablePuzzle::create();
    }

    /**
     * @return Condition
     */
    private function recalculateCondition(): Condition
    {
        $placedPieces = $this->getPieces();

        $nextPosition = count($placedPieces);

        if ($nextPosition == ($this->getBoard()->getWidth()) + 1) {

            $topPiecePosition = $nextPosition - $this->getBoard()->getWidth();

            $leftCondition = 0;
            $topCondition = $placedPieces[$topPiecePosition]->getSides()[1];

        } else {
            $leftPiecePosition = $nextPosition - 1;
            $topPiecePosition = $nextPosition - $this->getBoard()->getWidth();

            $leftCondition = $placedPieces[$leftPiecePosition]->getSides()[0];
            $topCondition = $placedPieces[$topPiecePosition]->getSides()[1];
        }

        return Condition::create($leftCondition, $topCondition);
    }

    /**
     * @param int $nextPosition
     * @return bool
     */
    private function pieceBelongsToBorderLeft(int $nextPosition): bool
    {
        return ($nextPosition % $this->getBoard()->getWidth()) === 0;
    }

    /**
     * @param int $nextPosition
     * @return bool
     */
    private function pieceBelongsToBorderTop(int $nextPosition): bool
    {
        return (($nextPosition + 1) / $this->getBoard()->getWidth()) <= 1;
    }

    /**
     * @param int $nextPosition
     * @return bool
     */
    private function pieceBelongsToBorderRight(int $nextPosition): bool
    {
        return (($nextPosition + 1) % $this->getBoard()->getWidth()) === 0;
    }

    private function pieceBelongsToBorderBottom($nextPosition):bool
    {
        return (($nextPosition +1) / $this->getBoard()->getWidth()) === $this->getBoard()->getWidth();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        foreach ($this->placedPieces as $piece) {
            $piece;
        }

        return '';
    }

}