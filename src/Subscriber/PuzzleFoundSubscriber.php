<?php
/**
 *
 */

namespace TalentedPanda\PuzzleProblem\Subscriber;

use TalentedPanda\PuzzleProblem\Event\PuzzleFound;
use TalentedPanda\PuzzleProblem\Model\Puzzle;
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
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException
     */
    public function handle($event)
    {
        $alreadyFoundSolutions = json_decode($this->solutionsFileManager->read($event->getPuzzle()->getPuzzleName()));

        $this->solutionsFileManager->write(
            json_encode(
                array_merge($alreadyFoundSolutions, [$event->getPuzzle()->getPieces()])
            )
        );
        if (empty($this->fileManager->getDocumentPath())) {
            $this->fileManager->setDocumentPath($event->getPuzzle()->getPuzzleName());
        }

        $solutions = $this->mergeDocument($event->getPuzzle());
//        $solution = "Solution found at " . $event->occuredOn()->format('H:i:s') . ": \n" . $event->getPuzzle()->toJson() . "\n\n";

    }



    /**
     * @param Puzzle $puzzle
     * @return false|string
     * @throws \TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException
     */
    private function mergeDocument(Puzzle $puzzle)
    {
        $content = $this->fileManager->read($puzzle->getPuzzleName());

        $this->fileManager->writeAttachingToPublic($content);
        $decoded = json_decode($content);
    }
}
