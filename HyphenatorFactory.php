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
use Org\Heigl\Hyphenator\Tokenizer;
use Org\Heigl\Hyphenator\Filter\Filter;

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

    /**
     * @var Tokenizer[]
     */
    private $tokenizers;

    /**
     * @var Filter[]
     */
    private $filters;

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
            $this->hyphenators[$locale] = Hyphenator::factory($this->path, $locale);
            $this->hyphenators[$locale]->setOptions($this->options);
            $this->hyphenators[$locale]->addDictionary($locale);

            // TODO remove if https://github.com/heiglandreas/Org_Heigl_Hyphenator/pull/21 gets merged
            foreach ($this->tokenizers as $tokenizer) {
                $this->hyphenators[$locale]->addTokenizer($tokenizer);
            }
            foreach ($this->filters as $filter) {
                $this->hyphenators[$locale]->addFilter($filter);
            }
        }

        return $this->hyphenators[$locale];
    }

    /**
     * @param Tokenizer[] $tokenizers
     */
    public function setTokenizers(array $tokenizers)
    {
        $this->tokenizers = $tokenizers;
    }

    /**
     * @param Filter[] $filters
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }
}
