<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 8/01/19
 */

namespace TalentedPanda\PuzzleProblem\Model;

use TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException;

class Piece
{
    const PIECE_SIDES = 4;
    const MAXIMUM_OUTER_SIDES = 2;
    const OUTER_SIDE_PART = 0;

    /** @var int */
    private $position;

    /** @var array */
    private $sides;

    /**
     * Piece constructor.
     * @param int $position
     * @param array $sides
     * @throws NonValidPieceException
     */
    public function __construct(int $position, array $sides)
    {
        if (!$this->isValid($sides)) {
            throw NonValidPieceException::create($position);
        }

        $this->position = $position;
        $this->sides = array_map(
            function ($side) {
                return (int)$side;
            },
            $sides);
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
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
        array_unshift(
            $newUnorderedSides,
            array_pop($newUnorderedSides)
        );
        return new Piece(
            $this->position,
            $newUnorderedSides
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
        return count(array_keys($sides, self::OUTER_SIDE_PART));
    }

    /**
     * @return array
     */
    public function getSides(): array
    {
        return $this->sides;
    }

    /**
     * @param Condition $condition
     * @return bool
     */
    public function meets(Condition $condition): bool
    {
        return (
            $this->meetsLeftCondition($condition->getSideConditions()) &&
            $this->meetsTopCondition($condition->getSideConditions()) &&
            $this->meetsRightCondition($condition->getSideConditions()) &&
            $this->meetsBottomCondition($condition->getSideConditions()));
    }

    /**
     * @param array $sideConditions
     * @return bool
     */
    private function meetsLeftCondition(array $sideConditions): bool
    {
        return (
            $sideConditions['left'] === $this->sides[0] ||
            ($sideConditions['left'] === Condition::ANY_SIDE_TYPE && $this->sides[0] !== 0)
        );
    }

    /**
     * @param array $sideConditions
     * @return bool
     */
    private function meetsTopCondition(array $sideConditions): bool
    {
        return (
            $sideConditions['top'] === $this->sides[1] ||
            ($sideConditions['top'] === Condition::ANY_SIDE_TYPE && $this->sides[1] !== 0)
        );
    }

    /**
     * @param array $sideConditions
     * @return bool
     */
    private function meetsRightCondition(array $sideConditions): bool
    {
        return (
            $sideConditions['right'] === $this->sides[2] ||
            ($sideConditions['right'] === Condition::ANY_SIDE_TYPE && $this->sides[2] !== 0)
        );
    }

    /**
     * @param array $sideConditions
     * @return bool
     */
    private function meetsBottomCondition(array $sideConditions): bool
    {
        return (
            $sideConditions['bottom'] === $this->sides[3] ||
            ($sideConditions['bottom'] === Condition::ANY_SIDE_TYPE && $this->sides[3] !== 0)
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return json_encode($this->sides);
    }
}