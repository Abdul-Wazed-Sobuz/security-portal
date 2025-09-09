<?php

use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\Exception\Configuration\InitializationException;
use Symplify\EasyCodingStandard\Exception\Configuration\SuperfluousConfigurationException;

try {
    return ECSConfig::configure()
        ->withPaths([__DIR__ . '/src', __DIR__ . '/tests'])
        ->withConfiguredRule(HeaderCommentFixer::class,
            ['header' => 'This file is part of Secure Portal project. 
     (c) AWS 2025 - ' . date('Y') . '. 
            '. 'All rights reserved.', 'location' => 'after_open']
        )
        ->withRules([
            NoUnusedImportsFixer::class,
        ])
        ->withPreparedSets(psr12: true, arrays: true, comments: true, docblocks: true, spaces: true, cleanCode: true);
} catch (InitializationException|SuperfluousConfigurationException $e) {
}
