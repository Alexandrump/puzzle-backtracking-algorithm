<?php
/**
 * @author: Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Lib\EventHelper;

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
