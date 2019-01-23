<?php
/**
 * @author: Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Service;

use TalentedPanda\PuzzleProblem\EventHelper\EventPublisher;
use TalentedPanda\PuzzleProblem\Lib\EventHelper\Event;

/**
 * Trait EventPublishingTrait
 */
trait EventPublishingTrait
{
    /**
     * @param Event $event
     *
     * @throws \Exception
     */
    private function publishEvent(Event $event)
    {
        EventPublisher::instance()->publish($event);
    }
}
