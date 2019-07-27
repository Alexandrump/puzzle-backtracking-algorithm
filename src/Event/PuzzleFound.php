<?php
/**
 * User: Alejandro Martínez Peregrina
 * Date: 22/01/19
 * Time: 14:39
 */

namespace TalentedPanda\PuzzleProblem\Event;

use TalentedPanda\PuzzleProblem\Service\EventHelper\Event;
use TalentedPanda\PuzzleProblem\Model\Puzzle;

class PuzzleFound implements Event
{
    /** @var \DateTimeImmutable */
    private $occuredOn;

    /** @var Puzzle */
    private $puzzle;

    /**
     * PuzzleFound constructor.
     * @param Puzzle $puzzle
     * @throws \Exception
     */
    public function __construct(Puzzle $puzzle)
    {
        $this->occuredOn = new \DateTimeImmutable();
        $this->puzzle = $puzzle;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occuredOn(): \DateTimeImmutable
    {
        return $this->occuredOn;
    }

    /**
     * @return Puzzle
     */
    public function getPuzzle(): Puzzle
    {
        return $this->puzzle;
    }

}