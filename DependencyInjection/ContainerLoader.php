<?php

namespace TalentedPanda\PuzzleProblem\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ContainerLoader
{

    /** @var ContainerBuilder|null */
    private static $instance = null;

    /**
     * @return ContainerBuilder
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = self::load();
        }

        return static::$instance;
    }

    /**
     * @return ContainerBuilder
     */
    private static function load()
    {

        $container = new ContainerBuilder();

        $parameterLoader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../'));
        $parameterLoader->load('parameters.yml');



        $serviceLoader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../definitions/'));
        $serviceLoader->load('services.yml');

        return $container;
    }
}
