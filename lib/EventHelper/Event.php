<?php
/**
 * @author: Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Lib\EventHelper;

interface Event
{
    /**
     * @return \DateTimeImmutable
     */
    public function occuredOn();
}
