<?php
/**
 *
 */

namespace TalentedPanda\PuzzleProblem\Subscriber\PuzzleFoundSubscriber;

use TalentedPanda\PuzzleProblem\Event\PuzzleFound;
use TalentedPanda\PuzzleProblem\Lib\EventHelper\EventSubscriberInterface;
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
     *
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException
     */
    public function handle($event)
    {
        $fileName = $event->getPuzzle()->namePuzzleFromDimension() . '_' . $event->getPuzzle()->getNameIdentifier();



        if (!$this->fileManager->existWithData($fileName)) {
            $this->fileManager->writeAttaching();
        }
        $this->fileManager->readFromPublic('Solutions', '');
    }
}
