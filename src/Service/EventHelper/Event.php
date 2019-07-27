<?php
/**
 * @author: Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Service\EventHelper;

interface Event
{
    /**
     * @return \DateTimeImmutable
     */
    public function occuredOn();
}
