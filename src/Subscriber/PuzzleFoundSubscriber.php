<?php
/**
 *
 */

namespace TalentedPanda\PuzzleProblem\Subscriber\PuzzleFoundSubscriber;

use TalentedPanda\PuzzleProblem\Event\PuzzleFound;
use TalentedPanda\PuzzleProblem\Lib\EventHelper\EventSubscriberInterface;

/**
 * Class TaskProgressStateChangeSubscriber
 */
class PuzzleFoundSubscriber implements EventSubscriberInterface
{

    /**
     * PuzzleFoundSubscriber constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param PuzzleFound $event
     *
     * @return bool
     */
    public function isSubscribedTo($event)
    {
        return ($event instanceof PuzzleFound);
    }

    /**
     * @param mixed $event
     */
    public function handle($event)
    {

    }
}
