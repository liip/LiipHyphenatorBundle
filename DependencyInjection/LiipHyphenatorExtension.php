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

class LiipHyphenatorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('hyphenator.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config as $key => $value) {
            if ('tokenizers' !== $key && 'filters' !== $key) {
                $container->setParameter(sprintf('liip_hyphenator.%s', $key), $value);
            }
        }

        $options = $container->getDefinition($this->getAlias().'.options');

        foreach ($config['tokenizers'] as $value) {
            $options->addMethodCall('addTokenizer', array($value));
        }

        foreach ($config['filters'] as $value) {
            $options->addMethodCall('addFilter', array($value));
        }
    }
}
