Introduction
============

Adds support for _hyphenating_ long words using the [Org_Heigl_Hyphenator](https://github.com/heiglandreas/Org_Heigl_Hyphenator) library.

This bundle will add a Twig Extension for templates and a Hyphenator service.

[![Build Status](https://secure.travis-ci.org/liip/LiipHyphenatorBundle.png)](http://travis-ci.org/liip/LiipHyphenatorBundle)

Installation
------------

 1. Download the Bundle
 
    Open a command console, enter your project directory and execute the
    following command to download the latest stable version of this bundle:

    ```bash
    $ composer require liip/hyphenator-bundle
    ```

    This command requires you to have Composer installed globally, as explained
    in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
    of the Composer documentation.

 2. Enable the Bundle

    Add the following line in the `app/AppKernel.php` file to enable this bundle only
    for the `test` environment:
   
    ```php
    <?php
    // app/AppKernel.php
   
    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            ..
            
            new Liip\HyphenatorBundle\LiipHyphenatorBundle(),
    
            return $bundles
        }
    
        // ...
    }
    ```

 3. Configure the bundle:

    The supported options for the Hyphenator with the defaults are:

    ```yaml
    # app/config/config.yml
    liip_hyphenator:
        language: en
        hyphen: &shy;
        left_min: 2
        right_min: 2
        word_min: 6
        quality: highest # either the quality name, either the value of the constant
        no_hyphenate_string: ''
        custom_hyphen: --
        tokenizers: ['liip_hyphenator.tokenizer.whitespace', 'liip_hyphenator.tokenizer.punctuation']
        filters: ['liip_hyphenator.filter.simple']
    ```

    All settings are optional.
    
    For details about their meaning consult the Hyphenator library documentation.

Usage
-----

This library adds a filter for twig templates that can be used like:

    {{ "Somelongwordtohyphenate"|hyphenate }}

Alternatively the filter can be applied to an entire block:

    {% filter hyphenate %}
    ...
    Somelongwordtohyphenate
    ....
    {% endfilter %}

Furthermore its possible to pass in a locale as a parameter if the default locale should not be used:

    {{ "Somelongwordtohyphenate"|hyphenate("de") }}
