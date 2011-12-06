<?php

namespace Liip\HyphenatorBundle\Extension;

use Org\Heigl\Hyphenator\Hyphenator;

class HyphenatorTwigExtension extends \Twig_Extension
{
    /**
     * @var Hyphenator
     */
    private $hyphenator;

    public function setHyphenator(Hyphenator $hyphenator)
    {
        $this->hyphenator = $hyphenator;
    }

    public function getFilters()
    {
        return array(
            'hyphenate'  => new \Twig_Filter_Method($this, 'hyphenate', array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    public function hyphenate($word)
    {
        return $this->hyphenator->hyphenate($word);
    }

    public function getName()
    {
        return 'liip_hyphenator';
    }
}
