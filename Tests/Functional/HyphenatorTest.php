<?php

/*
 * This file is part of the LiipHyphenatorBundle
 *
 * (c) Liip AG
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


namespace Liip\HyphenatorBundle\Tests\Functional;

class HyphenatorTest extends WebTestCase
{
    public function testFilterWithDefaultLanguage()
    {
        $client = $this->createClient(array('test_case' => 'Hyphenator'));
        $client->request(
            'GET',
            '/filter-with-default-language'
        );

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('<html>
    <body>
    <h1>Hyphenator</h1>

    Imagine you have text like this:
    <div style="width: 100px; border-style:solid; border-width:medium;">
        We have some really long words in german like sauerstofffeldflasche.
    </div>
    <br />
    Simply use the "|hyphenate" filter to automatically add soft-dashes:
    <div style="width: 100px; border-style:solid; border-width:medium;">
        We have some re&shy;al&shy;ly long words in ger&shy;man like sau&shy;er&shy;stoff&shy;feld&shy;fla&shy;sche.
    </div>
    <br />
    Here is the actual HTML code that was generated:
    <div>
        We have some re&amp;shy;al&amp;shy;ly long words in ger&amp;shy;man like sau&amp;shy;er&amp;shy;stoff&amp;shy;feld&amp;shy;fla&amp;shy;sche.
    </div>

    </body>
</html>
', $client->getResponse()->getContent());
    }

    public function testFilterWithCustomLanguage()
    {
        $client = $this->createClient(array('test_case' => 'Hyphenator'));
        $client->request(
            'GET',
            '/filter-with-custom-language'
        );

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('<html>
    <body>
    <h1>Hyphenator</h1>

    Imagine you have text like this:
    <div style="width: 100px; border-style:solid; border-width:medium;">
        Ceci est à remplacer par une fâble.
    </div>
    <br />
    Simply use the "|hyphenate" filter to automatically add soft-dashes:
    <div style="width: 100px; border-style:solid; border-width:medium;">
        Ceci est à rem&shy;pla&shy;cer par une fâble.
    </div>
    <br />
    Here is the actual HTML code that was generated:
    <div>
        Ceci est à rem&amp;shy;pla&amp;shy;cer par une fâble.
    </div>

    </body>
</html>
', $client->getResponse()->getContent());
    }
}
