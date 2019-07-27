<?php
/**
 * @author Alejandro Martínez Peregrina
 */

namespace TalentedPanda\PuzzleProblem\Subscriber;

use TalentedPanda\PuzzleProblem\Event\PuzzleFound;
use TalentedPanda\PuzzleProblem\Model\Piece;
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
     * @param $fileManager
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
    public function isSubscribedTo($event): bool
    {
        return ($event instanceof PuzzleFound);
    }

    /**
     * @param PuzzleFound $event
     */
    public function handle($event): void
    {
        if (!empty($this->fileManager->getDocumentPath())) {
            $alreadyFoundSolutions = json_decode($this->fileManager->readSolutions());

            $alreadyFoundSolutions[] = array_map(
                function (Piece $piece) {
                    return $piece->getPosition();
                }, $event->getPuzzle()->getPieces()
            );

            $this->fileManager->writeSolutions(
                json_encode(
                    array_unique($alreadyFoundSolutions, SORT_REGULAR)
                )
            );
        } else {
            $this->fileManager->setDocumentPath(
                $event->getPuzzle()->getPuzzleName(),
                FileManager::JSON_EXTENSION
            );
            $this->fileManager->writeSolutions(
                json_encode(
                    [array_map(function (Piece $piece) {
                        return $piece->getPosition();
                    }, $event->getPuzzle()->getPieces()
                    )]
                )
            );
        }
    }
}
