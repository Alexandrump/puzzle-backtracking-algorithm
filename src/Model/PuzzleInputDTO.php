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
    /** @var string */
    private $fileName;

    /** @var Board */
    private $board;

    /** @var PiecesBag */
    private $piecesBag;

    /**
     * PuzzleInputDTO constructor.
     * @param string $fileName
     * @param Board $board
     * @param PiecesBag $piecesBag
     */
    private function __construct(string $fileName, Board $board, PiecesBag $piecesBag)
    {
        $this->fileName = $fileName;
        $this->board = $board;
        $this->piecesBag = $piecesBag;
    }

    /**
     * @param string $fileName
     * @param Board $board
     * @param PiecesBag $piecesBag
     * @return PuzzleInputDTO
     */
    public static function create(string $fileName, Board $board, PiecesBag $piecesBag): PuzzleInputDTO
    {
        return new static($fileName, $board, $piecesBag);
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
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