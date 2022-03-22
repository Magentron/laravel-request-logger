<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in('src')
;

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'      => true,
        '@PhpCsFixer' => true,
        //'@PhpCsFixer:risky'        => true,
        'align_multiline_comment' => true,
        'array_indentation'       => true,
        'binary_operator_spaces'  => [
            'default' => 'align_single_space_minimal',
        ],
        'blank_line_after_namespace' => true,
        'concat_space'               => [
            'spacing' => 'one',
        ],
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_align'               => true,
        'phpdoc_types_order'         => [
            'null_adjustment' => 'always_last',
            'sort_algorithm'  => 'none',
        ],
        'php_unit_test_class_requires_covers' => false,
    ])
    ->setFinder($finder)
;

return $config;
