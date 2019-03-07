<?php

namespace Tenolo\Bundle\RefererBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Tenolo\Bundle\RefererBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class Configuration implements ConfigurationInterface
{

    const ROOT_NODE = 'tenolo_referer';

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(static::ROOT_NODE);

        if (method_exists($treeBuilder, 'getRootNode')) {
            // Symfony 4.2 +
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // Symfony 4.1 and below
            $rootNode = $treeBuilder->root(static::ROOT_NODE);
        }

        $rootNode->children()
            ->scalarNode('session_name')->cannotBeEmpty()->defaultValue('current_referer')->end()
            ->booleanNode('remove_params')->defaultTrue()->end()
            ->end();

        return $treeBuilder;
    }
}
