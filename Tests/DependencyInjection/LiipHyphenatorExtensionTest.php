<?php

/*
 * This file is part of the LiipHyphenatorBundle
 *
 * (c) Liip AG
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\HyphenatorBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Org\Heigl\Hyphenator\Hyphenator;
use Liip\HyphenatorBundle\DependencyInjection\LiipHyphenatorExtension;

class LiipHyphenatorExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $configuration;

    public function testQualityAsDefault()
    {
        $this->createConfiguration();

        $this->assertObjectPropertyEquals('liip_hyphenator.options', Hyphenator::QUALITY_HIGHEST, '_quality');
    }

    public function testQualityAsString()
    {
        $this->createConfiguration(array('quality' => 'normal'));

        $this->assertObjectPropertyEquals('liip_hyphenator.options', Hyphenator::QUALITY_NORMAL, '_quality');
    }

    public function testQualityAsInteger()
    {
        $this->createConfiguration(array('quality' => Hyphenator::QUALITY_LOW));

        $this->assertObjectPropertyEquals('liip_hyphenator.options', Hyphenator::QUALITY_LOW, '_quality');
    }

    /**
     * @return ContainerBuilder
     */
    private function createConfiguration($config = array())
    {
        $this->configuration = new ContainerBuilder();
        $loader = new LiipHyphenatorExtension();
        $loader->load(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    private function assertObjectPropertyEquals($id, $expected, $property)
    {
        $this->assertTrue($this->configuration->hasDefinition($id));

        $options = $this->configuration->get($id);
        $optionsRef = new \ReflectionClass($options);
        $propertyRef = $optionsRef->getProperty($property);
        $propertyRef->setAccessible(true);
        $this->assertEquals($expected, $propertyRef->getValue($options));
    }

    protected function tearDown()
    {
        unset($this->configuration);
    }
}
