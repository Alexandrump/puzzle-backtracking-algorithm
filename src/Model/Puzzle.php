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

    /** @var string */
    private $nameIdentifier;

    /**
     * Puzzle constructor.
     * @param array $placedPieces
     * @param Board $board
     * @param string $nameIdentifier
     */
    protected function __construct(array $placedPieces, Board $board, $nameIdentifier = '')
    {
        $this->board = $board;
        $this->placedPieces = $placedPieces;
        $this->nameIdentifier = empty($nameIdentifier) ? $this->createDefaultNameIdentifier() : $nameIdentifier;
    }

    /**
     * @param Piece $initialPiece
     * @param Board $board
     * @param Condition $initialCondition
     * @return Puzzle
     */
    public static function createFromCorner(Piece $initialPiece, Board $board, Condition $initialCondition)
    {
        $puzzle = new static([$initialPiece], $board);
        $puzzle->setCurrentCondition($initialCondition);

        return $puzzle;
    }

    /**
     * @param array $placedPieces
     * @param Board $board
     * @param string $name
     *
     * @return Puzzle
     */
    public static function create(array $placedPieces, Board $board, string $name): Puzzle
    {
        $puzzle = new static($placedPieces, $board, $name);
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
     * @return string
     */
    public function getNameIdentifier(): string
    {
        return $this->nameIdentifier;
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
                $this->getBoard(),
                $this->name
            );

            return $puzzle;
        }
        return UnsolvablePuzzle::createEmpty($this->getBoard());
    }

    /**
     *
     */
    private function recalculateCondition(): void
    {
        $placedPieces = $this->getPieces();

        $nextPosition = count($placedPieces);
        $previousPosition = $nextPosition - 1;
        $topPosition = $nextPosition - $this->getBoard()->getWidth();

        $leftCondition = $this->pieceBelongsToBorderLeft($nextPosition) ? 0 : $placedPieces[$previousPosition]->getSides()[2];
        $topCondition = $this->pieceBelongsToBorderTop($nextPosition) ? 0 : $placedPieces[$topPosition]->getSides()[3];
        $rightCondition = $this->pieceBelongsToBorderRight($nextPosition) ? 0 : -1;
        $bottomCondition = $this->pieceBelongsToBorderBottom($nextPosition) ? 0 : -1;

        $this->setCurrentCondition(Condition::create($leftCondition, $topCondition, $rightCondition, $bottomCondition));
    }

    /**
     * @param int $nextPosition
     * @return bool
     */
    private function pieceBelongsToBorderLeft(int $nextPosition): bool
    {
        return (($nextPosition + 1) % $this->getBoard()->getWidth()) === 1;
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

    /**
     * @param int $nextPosition
     * @return bool
     */
    private function pieceBelongsToBorderBottom(int $nextPosition): bool
    {
        return in_array(
            $nextPosition,
            range(
                ($this->getBoard()->getTotalNumberOfPieces()) - ($this->getBoard()->getWidth()),
                ($this->getBoard()->getTotalNumberOfPieces())
            )
        );
    }
    /**
     * @return int
     */
    public function totalPlacedPieces(): int
    {
        return count($this->placedPieces);
    }

    /**
     * @return string
     */
    public function namePuzzleFromDimension(): string
    {
        return $this->board->getWidth() . 'x' . $this->board->getHeight();
    }

    /**
     * @return string
     */
    private function createDefaultNameIdentifier(): string
    {
        return date("H_i_s_d_m_Y");
    }


    /**
     * @return string
     */
    public function __toString()
    {
        $puzzle = '';
        foreach ($this->placedPieces as $iteration => $piece) {
            if (($iteration + 1) % $this->getBoard()->getWidth() !== 0) {
                $puzzle .= ($piece->getPosition() + 1) . " ";
            } else {
                $puzzle .= ($piece->getPosition() + 1) . "\n";
            }
        }

        return $puzzle;
    }
}