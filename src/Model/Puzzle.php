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

    /** @var string */
    private $puzzleName;

    /**
     * Puzzle constructor.
     * @param array $placedPieces
     * @param Board $board
     * @param string $nameIdentifier
     */
    protected function __construct(array $placedPieces, Board $board, $nameIdentifier = '', $puzzleName = '')
    {
        $this->board = $board;
        $this->placedPieces = $placedPieces;
        $this->nameIdentifier = empty($nameIdentifier) ? $this->createDefaultNameIdentifier() : $nameIdentifier;
        $this->puzzleName = empty($puzzleName) ? $this->createDefaultPuzzleName() : $puzzleName;
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
     * @param string $identifier
     * @param string $puzzleName
     * @return Puzzle
     */
    public static function create(array $placedPieces, Board $board, string $identifier, string $puzzleName): Puzzle
    {
        $puzzle = new static($placedPieces, $board, $identifier, $puzzleName);
        $puzzle->recalculateCondition();

        return $puzzle;
    }

    /**
     * @return Piece[]
     */
    public function getPieces(): array
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
     * @return string
     */
    public function getPuzzleName(): string
    {
        return $this->puzzleName;
    }

    /**
     * @param Condition $currentCondition
     */
    private function setCurrentCondition(Condition $currentCondition): void
    {
        $this->currentCondition = $currentCondition;
    }

    /**
     * @param Piece $piece
     * @return Puzzle
     */
    public function placePiece(Piece $piece): Puzzle
    {
        if ($piece->meets($this->getCurrentCondition())
        ) {
            $puzzle = Puzzle::create(
                array_merge($this->getPieces(), [$piece]),
                $this->getBoard(),
                $this->getNameIdentifier(),
                $this->getPuzzleName()
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
    private function createDefaultPuzzleName(): string
    {
        return $this->namePuzzleFromDimension() . '_' . $this->getNameIdentifier();
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