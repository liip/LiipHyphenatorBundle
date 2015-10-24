<?php

/*
 * This file is part of the LiipHyphenatorBundle
 *
 * (c) Liip AG
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\HyphenatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;

class LiipHyphenatorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('hyphenator.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $options = $container->getDefinition($this->getAlias().'.options');
        $factory = $container->getDefinition($this->getAlias().'.hyphenator_factory');

        foreach ($config as $key => $value) {
            switch ($key) {
                case 'hyphen':
                    $options->addMethodCall('setHyphen', array($value));
                    break;
                case 'left_min':
                    $options->addMethodCall('setLeftMin', array($value));
                    break;
                case 'right_min':
                    $options->addMethodCall('setRightMin', array($value));
                    break;
                case 'word_min':
                    $options->addMethodCall('setWordMin', array($value));
                    break;
                case 'quality':
                    $options->addMethodCall('setQuality', array($value));
                    break;
                case 'no_hyphenate_string':
                    $options->addMethodCall('setNoHyphenateString', array($value));
                    break;
                case 'custom_hyphen':
                    $options->addMethodCall('setCustomHyphen', array($value));
                    break;

                case 'tokenizers':
                    foreach ($value as $i => $tokenizer) {
                        $value[$i] = new Reference($tokenizer);
                    }
                    $factory->addMethodCall('setTokenizers', array($value));
                    break;
                case 'filters':
                    foreach ($value as $i => $filter) {
                        $value[$i] = new Reference($filter);
                    }
                    $factory->addMethodCall('setFilters', array($value));
                    break;
                case 'home_path':
                    $factory->replaceArgument(1, $value);
                    break;
                case 'default_locale':
                    $factory->replaceArgument(2, $value);
                    break;
            }
        }
    }
}
