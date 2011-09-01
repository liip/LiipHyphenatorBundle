# LiipHyphenatorBundle #

## About ##

Adds support for _hyphenating_ long words using the [Org_Heigl_Hyphenator](https://github.com/heiglandreas/Org_Heigl_Hyphenator) library. 

This bundle will add a Twig Extension for templates and a Hyphenator service.

## Prerequisites ##

    1. Install the Hyphenator library as a Git submodule:

        $ git submodule add git://github.com/heiglandreas/Org_Heigl_Hyphenator.git vendor/OrgHeiglHyphenator

    2. Add the Hyphenator library in your `autoload.php` file

        //Load Hyphenator
        require_once __DIR__ . '/../vendor/OrgHeiglHyphenator/src/Org/Heigl/Hyphenator.php';

## Installation ##

    1. Add this bundle to your project as a Git submodule:

        $ git submodule add git://github.com/liip/LiipHyphenatorBundle.git vendor/bundles/Liip/LiipHyphenatorBundle

    2. Add the Liip namespace to your autoloader:

        // app/autoload.php
        $loader->registerNamespaces(array(
            'Liip' => __DIR__.'/../vendor/bundles',
            // your other namespaces
        ));

    3. Add this bundle to your application's kernel:

        // application/ApplicationKernel.php
        public function registerBundles()
        {
          return array(
              // ...
              new Liip\HyphenatorBundle\LiipHyphenatorBundle(),
              // ...
          );
        }

## Configuration ##

The supported options for the Hyphenator with the defaults are:

    <parameters>
        <parameter key="hyphenator.language">de</parameter>
        <parameter key="hyphenator.hyphen">&amp;shy;</parameter>
        <parameter key="hyphenator.left.min">5</parameter>
        <parameter key="hyphenator.word.min">5</parameter>
        <parameter key="hyphenator.special.chars">äöü</parameter>
        <parameter key="hyphenator.quality">7</parameter>
        <parameter key="hyphenator.no.hyphenate.marker">nbr:</parameter>
        <parameter key="hyphenator.custom.hyphen">--</parameter>
    </parameters>

For details about their meaning consult the Hyphenator library documentation.

Then on your `config.yml` file you need to add a line like:

    liip_hyphenator: ~

## Usage ##

This library adds a filter for twig templates that can be used like:

    {{ "Somelongwordtohyphenate"|hyphenate|raw }}

Since it's using soft-hyphens you need to add the `raw` filter in order that the `&shy;` characters are sent to the templates.

## License ##

See `LICENSE`.