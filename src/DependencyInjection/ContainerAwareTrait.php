<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

trait ContainerAwareTrait
{
    /**
     * @return ContainerBuilder
     * @throws \Exception
     */
    public function getContainer() : ContainerBuilder
    {
        return ContainerLoader::instance();
    }

    /**
     * @param $service
     * @return object
     * @throws \Exception
     */
    public function get($service) : object
    {
        return $this->getContainer()->get($service);
    }
}