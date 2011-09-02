<?php

namespace Liip\HyphenatorBundle\Extension;

class HyphenatorTwigExtension extends \Twig_Extension
{
    private $hyphenator;

    public function setHyphenator($hyphenator)
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