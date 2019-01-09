<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 9/01/19
 * Time: 13:18
 */

class MatchFinder
{

    public function findValidCandidates($remainingPieces, $condition)
    {
        foreach ($remainingPieces as $piece) {
            for ($i = 0; $i < $totalNumberOfSides; $i++) {
                $rotation = $piece->rotate();
                if ($condition->check()) {
                    yield $rotation;
                }
            }
        }
    }


}