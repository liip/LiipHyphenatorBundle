<?php

/*
 * This file is part of the LiipHyphenatorBundle
 *
 * (c) Liip AG
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\HyphenatorBundle;

use Org\Heigl\Hyphenator\Hyphenator;
use Org\Heigl\Hyphenator\Options;

class HyphenatorFactory
{
    /**
     * @var Options
     */
    private $options;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var Hyphenator[]
     */
    private $hyphenators;

    public function __construct(Options $options, $path, $defaultLocale)
    {
        $this->options = $options;
        $this->path = $path;
        $this->defaultLocale = $defaultLocale;
    }

    public function getInstance($locale = null)
    {
        $locale = $locale ?: $this->defaultLocale;

        if (empty($this->hyphenators[$locale])) {
            $this->hyphenators[$locale] = Hyphenator::factory(null, $locale);
            $this->hyphenators[$locale]->setOptions($this->options);
            $this->hyphenators[$locale]->addDictionary($locale);
        }

        return $this->hyphenators[$locale];
    }
}
