<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 9/01/19
 * Time: 13:18
 */

namespace TalentedPanda\PuzzleProblem\Service;

use TalentedPanda\PuzzleProblem\Model\Condition;
use TalentedPanda\PuzzleProblem\Model\Exception\NonExistentPieceException;
use TalentedPanda\PuzzleProblem\Model\Exception\NonValidPieceException;
use TalentedPanda\PuzzleProblem\Model\Piece;

class MatchFinder
{
    /**
     * @param Piece[] $remainingPieces
     * @param Condition $condition
     * @return \Generator
     */
    public function findValidCandidates(array $remainingPieces, Condition $condition): \Generator
    {
        foreach ($remainingPieces as $piece) {
            for ($rotation = 0; $rotation < Piece::PIECE_SIDES; $rotation++) {
                $rotatedPiece = $piece->rotate();
                if ($condition->check($rotatedPiece)) {
                    yield $rotatedPiece;
                }
            }
        }
    }

    /**
     * @param Piece[] $remainingPieces
     * @param Condition $condition
     * @return Piece
     * @throws NonValidPieceException
     * @throws NonExistentPieceException
     */
    public function findOneCandidate($remainingPieces, $condition): Piece
    {
        foreach ($remainingPieces as $piece) {
            for ($rotation = 0; $rotation < Piece::PIECE_SIDES; $rotation++) {
                $rotatedPiece = $piece->rotate90Degrees();
                if ($condition->check($rotatedPiece)) {
                    return $rotatedPiece;
                }
            }
        }
        throw new NonExistentPieceException();
    }
}