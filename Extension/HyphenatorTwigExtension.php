<?php

/*
 * This file is part of the LiipHyphenatorBundle
 *
 * (c) Liip AG
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\HyphenatorBundle\Extension;

use Liip\HyphenatorBundle\HyphenatorFactory;

class HyphenatorTwigExtension extends \Twig_Extension
{
    /**
     * @var HyphenatorFactory
     */
    private $factory;

    public function setHyphenatorFactory(HyphenatorFactory $factory)
    {
        $this->factory = $factory;
    }

    public function getFilters()
    {
        return array(
            'hyphenate' => new \Twig_SimpleFilter('hyphenate', array($this, 'hyphenate'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    public function hyphenate($word, $locale = null)
    {
        return $this->factory->getInstance($locale)->hyphenate($word);
    }

    public function getName()
    {
        return 'liip_hyphenator';
    }
}
