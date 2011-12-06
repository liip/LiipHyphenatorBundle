<?php

namespace Liip\HyphenatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Org\Heigl\Hyphenator\Hyphenator;

/**
 * This class contains the configuration information for the bundle
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('liip_hyphenator');

        $rootNode
            ->children()
                ->scalarNode('language')->defaultValue('en')->end()
                ->scalarNode('hyphen')->defaultValue('&shy;')->end()
                ->scalarNode('left_min')->defaultValue(2)->end()
                ->scalarNode('right_min')->defaultValue(2)->end()
                ->scalarNode('word_min')->defaultValue(6)->end()
                ->scalarNode('quality')
                    ->defaultValue(Hyphenator::QUALITY_HIGHEST)
                    ->beforeNormalization()
                        ->ifString()
                        ->then(function($v) {
                            return constant('Org\Heigl\Hyphenator\Hyphenator::QUALITY_'.strtoupper($v));
                        })
                    ->end()
                ->end()
                ->scalarNode('no_hyphenate_string')->defaultNull()->end()
                ->scalarNode('custom_hyphen')->defaultValue('--')->end()
            ->end();

        return $treeBuilder;
    }
}
