<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 16/01/19
 * Time: 9:19
 */

namespace TalentedPanda\PuzzleProblem\Model;


class PuzzleInputDTO
{
    /** @var Board */
    private $board;

    /** @var PiecesBag */
    private $piecesBag;

    /**
     * PuzzleInputDTO constructor.
     * @param Board $board
     * @param PiecesBag $piecesBag
     */
    private function __construct(Board $board, PiecesBag $piecesBag)
    {
        $this->board = $board;
        $this->piecesBag = $piecesBag;
    }

    /**
     * @param Board $board
     * @param PiecesBag $piecesBag
     * @return PuzzleInputDTO
     */
    public static function create(Board $board, PiecesBag $piecesBag): PuzzleInputDTO
    {
        return new static($board, $piecesBag);
    }

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * @return PiecesBag
     */
    public function getPiecesBag(): PiecesBag
    {
        return $this->piecesBag;
    }

}