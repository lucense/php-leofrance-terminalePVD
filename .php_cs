<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'array_indentation' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => ['space' => 'single'],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'method_chaining_indentation' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
    ])
    ->setLineEnding("\n");
