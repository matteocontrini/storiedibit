<?php

Kirby::plugin('storiedibit/newsletter-section', [
    'blueprints' => [
        'blocks/newsletter-section' => __DIR__ . '/blueprints/blocks/newsletter-section.yml'
    ],
    'snippets' => [
        'blocks/newsletter-section' => __DIR__ . '/snippets/blocks/newsletter-section.php'
    ]
]);
