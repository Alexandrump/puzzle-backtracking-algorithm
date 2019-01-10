<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace Model;

use Model\Exception\NonValidPiecesBagException;

class PiecesBag
{
    /** @var Piece[] */
    private $remainingPieces;

    /**
     * PiecesBag constructor.
     * @param array $remainingPieces
     * @param int $totalPieces
     * @param bool $isFull
     * @throws NonValidPiecesBagException
     */
    public function __construct(array $remainingPieces, int $totalPieces, bool $isFull = false)
    {

        if ($this->initialStateNotStartable($remainingPieces, $totalPieces, $isFull)) {
            throw new NonValidPiecesBagException();
        }

        $this->remainingPieces = $remainingPieces;
    }

    public static function initialize(array $remainingPieces, int $totalPieces, bool $isFull)
    {

    }

    /**
     * @return Piece[]
     */
    public function getRemainingPieces(): array
    {
        return $this->remainingPieces;
    }

    /**
     * @param Piece $piece
     * @return PiecesBag
     */
    public function remove(Piece $piece): PiecesBag
    {
        $this->remainingPieces = array_diff($this->remainingPieces, [$piece]);

        return $this;
    }

    /**
     * @param array $pieces
     * @param int $totalPieces
     * @param bool $isFull
     * @return bool
     */
    private function initialStateNotStartable(array $pieces, int $totalPieces, bool $isFull): bool
    {
        return ($isFull && count($pieces) !== $totalPieces && count($pieces) % 2 !== 0);
    }

    private function processPieces($pieces): array
    {
        return array_map(function () {

        },
            $pieces);
    }

}