<?php
/**
 * User: Alejandro Martínez Peregrina
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
     * @param array $remainingPieces
     * @param Condition $condition
     * @return \Generator
     */
    public function findValidCandidates(array $remainingPieces, Condition $condition): \Generator
    {
        foreach ($remainingPieces as $piece) {
            for ($rotation = 0; $rotation < Piece::PIECE_SIDES; $rotation++) {
                if ($rotation !== 0) {
                    $rotatedPiece = $piece->rotate90Degrees();
                } else {
                    $rotatedPiece = $piece;
                }
                if ($condition->check($rotatedPiece)) {
                    yield $rotatedPiece;
                } else {
                    $piece = $rotatedPiece;
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
    public function findOneCandidate(array $remainingPieces, Condition $condition): Piece
    {
        foreach ($remainingPieces as $piece) {
            for ($rotation = 0; $rotation < Piece::PIECE_SIDES; $rotation++) {
                if ($rotation !== 0) {
                    $rotatedPiece = $piece->rotate90Degrees();
                } else {
                    $rotatedPiece = $piece;
                }
                if ($condition->check($rotatedPiece)) {
                    return $rotatedPiece;
                } else {
                    $piece = $rotatedPiece;
                }
            }
        }
        throw new NonExistentPieceException();
    }
}