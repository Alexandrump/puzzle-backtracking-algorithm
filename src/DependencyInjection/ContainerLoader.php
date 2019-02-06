<?php

/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

class ContainerLoader
{

    /** @var ContainerBuilder|null */
    private static $instance = null;

    /**
     * @return ContainerBuilder|null
     * @throws \Exception
     */
    public static function instance(): ?ContainerBuilder
    {
        if (null === static::$instance) {
            static::$instance = self::load();
        }

        return static::$instance;
    }

    /**
     * @return ContainerBuilder
     * @throws \Exception
     */
    private static function load(): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $parameterLoader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $parameterLoader->load('parameters.yml');

        $serviceLoader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config/definitions'));
        $serviceLoader->load('services.yml');

        return $container;
    }
}
