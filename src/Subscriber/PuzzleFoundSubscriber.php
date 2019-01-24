<?php
/**
 *
 */

namespace TalentedPanda\PuzzleProblem\Subscriber\PuzzleFoundSubscriber;

use TalentedPanda\PuzzleProblem\Event\PuzzleFound;
use TalentedPanda\PuzzleProblem\Service\EventHelper\EventSubscriberInterface;
use TalentedPanda\PuzzleProblem\Service\FileManager;

/**
 * Class TaskProgressStateChangeSubscriber
 */
class PuzzleFoundSubscriber implements EventSubscriberInterface
{
    /** @var FileManager */
    private $fileManager;

    /**
     * PuzzleFoundSubscriber constructor.
     * @param FileManager $fileManager
     */
    public function __construct($fileManager)
    {
        $this->fileManager = $fileManager;
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
     * @param PuzzleFound $event
     */
    public function handle($event)
    {
        if (empty($this->fileManager->getDocumentPath())) {
            $this->fileManager->setDocumentPath($event->getPuzzle()->getPuzzleName());
        }

        $solution = "Solution found at " . $event->occuredOn()->format('H:i:s') . ": \n" . $event->getPuzzle() . "\n\n";

        $this->fileManager->writeAttachingToPublic($solution);
    }
}
