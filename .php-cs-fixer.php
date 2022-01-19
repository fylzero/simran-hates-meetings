<?php

use PhpCsFixer\Config;
use Symfony\Component\Finder\Finder;

$finder = Finder::create()
    ->exclude('bootstrap/')
    ->exclude('node_modules/')
    ->exclude('public/')
    ->exclude('storage/')
    ->exclude('vendor/')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return Config::create()
    ->setRiskyAllowed(false)
    ->setRules([
        '@PSR2' => true,
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        'trailing_comma_in_multiline_array' => true,
    ])
    ->setFinder($finder);
