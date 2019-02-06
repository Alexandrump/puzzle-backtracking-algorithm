<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\Model;

use TalentedPanda\PuzzleProblem\Model\Exception\NonValidPiecesBagException;

class PiecesBag
{
    /** @var Piece[] */
    private $remainingPieces;

    /**
     * PiecesBag constructor.
     * @param array $remainingPieces
     */
    public function __construct(array $remainingPieces)
    {
        $this->remainingPieces = $remainingPieces;
    }

    /**
     * @param array $initialPieces
     * @param int $totalExpectedPieces
     * @return PiecesBag
     * @throws NonValidPiecesBagException
     */
    public static function initialize(array $initialPieces, int $totalExpectedPieces): PiecesBag
    {
        $piecesBag = new PiecesBag(
            self::processPieces(
                $initialPieces
            )
        );

        if ($piecesBag->initialStateNotStartable($initialPieces, $totalExpectedPieces)) {
            throw new NonValidPiecesBagException();
        }

        return $piecesBag;
    }

    /**
     * @param $remainingPieces
     * @return PiecesBag
     */
    public static function createFromArray($remainingPieces): PiecesBag
    {
        return new static($remainingPieces);
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
        $remainningPieces = $this->remainingPieces;
//        unset($this->remainingPieces[$piece->getPosition()]);
        unset($remainningPieces[$piece->getPosition()]);

        return new static($remainningPieces);
    }

    /**
     * @param array $pieces
     * @param int $totalPieces
     * @return bool
     */
    private function initialStateNotStartable(array $pieces, int $totalPieces): bool
    {
        return (count($pieces) !== $totalPieces && count($pieces) % 2 !== 0);
    }

    /**
     * @param array $pieces
     * @return Piece[]
     */
    private static function processPieces($pieces): array
    {
        return array_map(
            function ($piece, $position) {
                return new Piece(
                    $position,
                    explode(" ", $piece)
                );
            },
            $pieces,
            (array_keys($pieces)));
    }

}