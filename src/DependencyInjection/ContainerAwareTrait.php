<?php
/**
 * @author marcos.delafuente
 */

namespace TalentedPanda\PuzzleProblem\DependencyInjection;


trait ContainerAwareTrait
{
    public function getContainer()
    {
        return ContainerLoader::instance();
    }

    /**
     * @param $service
     * @return object
     * @throws \Exception
     */
    public function get($service)
    {
        return $this->getContainer()->get($service);
    }
}