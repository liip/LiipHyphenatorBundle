<?php

/*
 * This file is part of the LiipHyphenatorBundle
 *
 * (c) Liip AG
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\HyphenatorBundle\Tests\Functional\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function filterWithDefaultLanguageAction()
    {
        return $this->render('TestBundle::filterWithDefaultLanguage.html.twig');
    }

    public function filterWithCustomLanguageAction()
    {
        return $this->render('TestBundle::filterWithCustomLanguage.html.twig');
    }
}
