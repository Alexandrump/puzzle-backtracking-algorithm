<?php
/**
 * User: Alejandro Martínez Peregrina
 * Date: 9/01/19
 */

namespace Model;

class Condition
{
    /** @var array */
    private $sideCondition = [];

    /**
     * Condition constructor.
     * @param $sideCondition
     */
    public function __construct($sideCondition)
    {
        $this->sideCondition = $sideCondition;
    }

    /**
     * @param $leftSideShape
     * @param $topSideShape
     * @param $rightSideShape
     * @param $bottomSideShape
     * @return Condition
     */
    public static function create($leftSideShape, $topSideShape, $rightSideShape, $bottomSideShape): Condition
    {
        $sideCondition = [];

        if (!empty($leftSideShape)) {
            $sideCondition ['left'] = $leftSideShape;
        }
        if (!empty($topSideShape)) {
            $sideCondition ['top'] = $topSideShape;
        }
        if (!empty($rightSideShape)) {
            $sideCondition['right'] = $rightSideShape;
        }
        if (!empty($bottomSideShape)) {
            $sideCondition['bottom'] = $bottomSideShape;
        }

        return new static($sideCondition);
    }

    /**
     * @param Piece $piece
     * @return bool
     */
    public function check(Piece $piece) :bool
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