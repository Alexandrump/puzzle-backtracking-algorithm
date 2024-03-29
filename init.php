<?php
require('vendor/autoload.php');

use TalentedPanda\PuzzleProblem\DependencyInjection\ContainerLoader;
use TalentedPanda\PuzzleProblem\Service\EventHelper\EventPublisher;

error_reporting(E_ERROR | E_PARSE);

try {
    EventPublisher::instance()->register(
        [
            ContainerLoader::instance()->get(
                'talented_panda.puzzle_problem.event.puzzle_found_subscriber'
            ),
        ]
    );

} catch (Exception $exception) {
    echo "It was impossible loading the application.\n";
}