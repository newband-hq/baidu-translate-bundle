<?php

namespace Newband\Baidu\Translate\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Newband\Baidu\Translate\DependencyInjection
 * @author Zafar <zafar@newband.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('newband_baidu_translate');
        $rootNode
            ->children()
                ->scalarNode('appid')
                    ->isRequired()
                ->end()
                ->scalarNode('secretKey')
                    ->isRequired()
                ->end()
            ->end();

        return $treeBuilder;
    }
}