<?php
/**
 *
 */

namespace TalentedPanda\PuzzleProblem\Lib\EventHelper;

interface Event
{
    /**
     * @return \DateTimeImmutable
     */
    public function occuredOn();
}
