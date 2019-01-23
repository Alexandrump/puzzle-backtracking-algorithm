<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 23/01/19
 * Time: 8:55
 */

namespace TalentedPanda\PuzzleProblem\Handler;


use TalentedPanda\PuzzleProblem\Model\Board;
use TalentedPanda\PuzzleProblem\Model\Condition;
use TalentedPanda\PuzzleProblem\Model\Piece;
use TalentedPanda\PuzzleProblem\Model\PiecesBag;

class PuzzleSolutionCommand
{
    /** @var Piece */
    private $firstPiece;
    /** @var PiecesBag */
    private $piecesBag;
    /** @var Condition */
    private $initialCondition;
    /** @var Board  */
    private $board;

    /**
     * PuzzleSolutionCommand constructor.
     * @param Piece $firstPiece
     * @param PiecesBag $piecesBag
     * @param Condition $initialCondition
     * @param Board $board
     */
    private function __construct(Piece $firstPiece, PiecesBag $piecesBag, Condition $initialCondition, Board $board)
    {
        $this->firstPiece = $firstPiece;
        $this->piecesBag = $piecesBag;
        $this->initialCondition = $initialCondition;
        $this->board = $board;
    }

    /**
     * @param Piece $firstPiece
     * @param PiecesBag $piecesBag
     * @param Condition $initialCondition
     * @param Board $board
     * @return PuzzleSolutionCommand
     */
    public static function create(Piece $firstPiece, PiecesBag $piecesBag, Condition $initialCondition, Board $board)
    {
        return new static($firstPiece, $piecesBag, $initialCondition, $board);
    }

    /**
     * @return Piece
     */
    public function getFirstPiece(): Piece
    {
        return $this->firstPiece;
    }

    /**
     * @return PiecesBag
     */
    public function getPiecesBag(): PiecesBag
    {
        return $this->piecesBag;
    }

    /**
     * @return Condition
     */
    public function getInitialCondition(): Condition
    {
        return $this->initialCondition;
    }

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

}