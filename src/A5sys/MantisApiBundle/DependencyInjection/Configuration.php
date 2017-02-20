<?php

namespace A5sys\MantisApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('mantis_api')->children()
            ->scalarNode('username')->defaultValue('admin')->end()
            ->scalarNode('password')->defaultValue('root')->end()
            ->scalarNode('url')->defaultValue('http://127.0.0.1/mantisbt/api/soap/mantisconnect.php?wsdl')->end()
        ->end();

        return $treeBuilder;
    }
}
