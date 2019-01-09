<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

class Piece
{
    const PIECE_SIDES = 4;
    const MAXIMUM_OUTER_SIDES = 2;
    const OUTER_SIDE_PART = 0;

    /** @var array */
    private $sides;

    /**
     * Piece constructor.
     * @param $sides
     * @throws NonValidPieceException
     */
    public function __construct($sides)
    {
        if (!$this->isValid($sides)) {
            throw new NonValidPieceException();
        }

        $this->sides = $sides;
    }

    /**
     * @return bool
     */
    public function isCorner(): bool
    {
        return $this->calculateOuterSides($this->sides) === self::MAXIMUM_OUTER_SIDES;
    }

    /**
     * @return bool
     */
    public function isBorder(): bool
    {
        return $this->calculateOuterSides($this->sides) === 1;
    }

    /**
     * @return Piece
     * @throws NonValidPieceException
     */
    public function rotate90Degrees(): Piece
    {
        $newUnorderedSides = $this->sides;
        return new Piece(
            array_unshift($newUnorderedSides[0], array_pop($newUnorderedSides))
        );
    }

    /**
     * @param $sides
     * @return bool
     */
    private function isValid($sides): bool
    {
        return (
            $this->hasDefinedSides($sides)
            &&
            $this->hasTwoOuterSidesMaximum($sides)
        );
    }

    /**
     * @param $sides
     * @return bool
     */
    private function hasDefinedSides($sides): bool
    {
        return count($sides) === self::PIECE_SIDES;
    }

    /**
     * @param $sides
     * @return bool
     */
    private function hasTwoOuterSidesMaximum($sides): bool
    {
        return $this->calculateOuterSides($sides) <= self::MAXIMUM_OUTER_SIDES;
    }

    /**
     * @param $sides
     * @return int
     */
    private function calculateOuterSides($sides): int
    {
        return array_reduce(
            $sides,
            function ($occurrences, $side) {
                return ($side === self::OUTER_SIDE_PART) ? $occurrences++ : $occurrences;
            },
            0
        );
    }

    /**
     * @param Condition $condition
     * @return bool
     */
    public function meets(Condition $condition)
    {
        $conditions = $condition->getConditions();

        return (
            (empty($conditions['left']) || $conditions['left'] === $this->sides[0]) &&
            (empty($conditions['top']) || $conditions['top'] === $this->sides[1]) &&
            (empty($conditions['right']) || $conditions['right'] === $this->sides[2]) &&
            (empty($conditions['bottom']) || $conditions['bottom'] === $this->sides[3])
        );

    }

}