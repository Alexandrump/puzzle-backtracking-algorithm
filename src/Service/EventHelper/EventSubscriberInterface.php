<?php
/**
 * @author: Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Service\EventHelper;

/**
 * Interface EventSubscriber
 */
interface EventSubscriberInterface
{

    /**
     * @param mixed $event
     *
     * @return bool
     */
    public function isSubscribedTo($event);

    /**
     * @param mixed $event
     */
    public function handle($event);
}
