<?php

namespace Tenolo\Bundle\RefererBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class TenoloRefererExtension
 *
 * @package Tenolo\Bundle\RefererBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloRefererExtension extends ConfigurableExtension
{

    /**
     * @inheritdoc
     */
    public function loadInternal(array $configs, ContainerBuilder $container)
    {
        $locator = new FileLocator(__DIR__.'/../Resources/config');
        $loader = new Loader\YamlFileLoader($container, $locator);
        $loader->load('services.yml');

        $container->setParameter('tenolo_referer.session_name', $configs['session_name']);
        $container->setParameter('tenolo_referer.remove_params', $configs['remove_params']);
    }

}
