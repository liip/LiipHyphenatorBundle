<?php

namespace Liip\HyphenatorBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Liip\HyphenatorBundle\DependencyInjection\LiipHyphenatorExtension;

class LiipHyphenatorExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $configuration;

    public function testQualityAsDefault()
    {
        $this->createConfiguration();

        $this->assertParameter(\Org_Heigl_Hyphenator::QUALITY_HIGHEST, 'liip_hyphenator.quality');
    }

    public function testQualityAsString()
    {
        $this->createConfiguration(array('quality' => 'normal'));

        $this->assertParameter(\Org_Heigl_Hyphenator::QUALITY_NORMAL, 'liip_hyphenator.quality');
    }

    public function testQualityAsInteger()
    {
        $this->createConfiguration(array('quality' => \Org_Heigl_Hyphenator::QUALITY_LOW));

        $this->assertParameter(\Org_Heigl_Hyphenator::QUALITY_LOW, 'liip_hyphenator.quality');
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

    private function assertAlias($value, $key)
    {
        $this->assertEquals($value, (string) $this->configuration->getAlias($key), sprintf('%s alias is correct', $key));
    }

    private function assertParameter($value, $key)
    {
        $this->assertEquals($value, $this->configuration->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    private function assertNotHasDefinition($id)
    {
        $this->assertFalse(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    protected function tearDown()
    {
        unset($this->configuration);
    }
}
