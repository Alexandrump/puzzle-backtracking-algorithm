<?php
/**
 * @author: Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Service;

use TalentedPanda\PuzzleProblem\Service\EventHelper\Event;
use TalentedPanda\PuzzleProblem\Service\EventHelper\EventPublisher;

/**
 * Trait EventPublishingTrait
 */
trait EventPublishingTrait
{
    /**
     * @param Event $event
     * @throws \Exception
     */
    private function publishEvent(Event $event): void
    {
        EventPublisher::instance()->publish($event);
    }
}
