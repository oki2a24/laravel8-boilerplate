<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.1.0|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude('bootstrap/cache')
        ->exclude('node_modules')
        ->exclude('storage/framework/views')
        ->exclude('vendor')
        ->notPath('_ide_helper.php')
        ->in(__DIR__)
    )
;
