<?php
/**
 * User: Alejandro Martínez Peregrina
 * Date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\Model;

class Condition
{
    const ANY_SIDE_TYPE = -1;

    /** @var array */
    private $sideCondition = [];

    /**
     * Condition constructor.
     * @param $sideCondition
     */
    private function __construct($sideCondition)
    {
        $this->sideCondition = $sideCondition;
    }

    /**
     * @param int $leftSideShape
     * @param int $topSideShape
     * @param int $rightSideShape
     * @param int $bottomSideShape
     * @return Condition
     */
    public static function create(
        int $leftSideShape =  self::ANY_SIDE_TYPE,
        int $topSideShape =  self::ANY_SIDE_TYPE,
        int $rightSideShape =  self::ANY_SIDE_TYPE,
        int $bottomSideShape = self::ANY_SIDE_TYPE
    ): Condition
    {
        $sideCondition = [];

        $sideCondition['left'] = $leftSideShape;
        $sideCondition['top'] = $topSideShape;
        $sideCondition['right'] = $rightSideShape;
        $sideCondition['bottom'] = $bottomSideShape;

        return new static($sideCondition);
    }

    /**
     * @return Condition
     */
    public static function createDefaultInitial()
    {
        return self::create(0, 0, self::ANY_SIDE_TYPE, self::ANY_SIDE_TYPE);
    }

    /**
     * @param Piece $piece
     * @return bool
     */
    public function check(Piece $piece): bool
    {
        if ($piece->meets($this)) {
            return true;
        };

        return false;
    }

    /**
     * @return array
     */
    public function getSideConditions()
    {
        return $this->sideCondition;
    }

}