<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['var', 'vendor'])
    ->in(__DIR__);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@Symfony' => true,
    '@PSR12' => true,
    'no_useless_return' => true,
    'array_syntax' => ['syntax' => 'short'],
    'concat_space' => ['spacing' => 'one'],
    'function_typehint_space' => true,
    'no_empty_statement' => true,
    'no_leading_namespace_whitespace' => true,
    'single_trait_insert_per_statement' => true,
    'yoda_style' => false,
    'array_indentation' => true,
    'single_quote' => true,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
])->setFinder($finder);
