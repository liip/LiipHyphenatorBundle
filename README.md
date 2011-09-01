# LiipHyphenatorBundle #

## About ##

Adds support for _hyphenating_ long words using the [Org_Heigl_Hyphenator](https://github.com/heiglandreas/Org_Heigl_Hyphenator) library.

This bundle will add a Twig Extension for templates and a Hyphenator service.

## Prerequisites ##

    1. Install the Hyphenator library as a Git submodule:

        $ git submodule add git://github.com/heiglandreas/Org_Heigl_Hyphenator.git vendor/OrgHeiglHyphenator

    2. Add the Hyphenator library in your `autoload.php` file

        // app/autoload.php
        $loader->registerPrefixes(array(
            'Org_Heigl_' => __DIR__.'/../vendor/OrgHeiglHyphenator/src',
            // your other namespaces
        ));

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

    liip_hyphenator:
        language: en
        hyphen: &shy;
        left_min: 2
        right_min: 2
        word_min: 6
        special_chars: ''
        quality: highest # either the quality name, either the value of the constant
        no_hyphenate_marker: ''
        custom_hyphen: --

All settings are optional.

For details about their meaning consult the Hyphenator library documentation.

## Usage ##

This library adds a filter for twig templates that can be used like:

    {{ "Somelongwordtohyphenate"|hyphenate|raw }}

Since it's using soft-hyphens you need to add the `raw` filter in order that the `&shy;` characters are sent to the templates.

## License ##

See `LICENSE`.