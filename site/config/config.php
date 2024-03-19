<?php

return [
    'debug' => false,
    'ready' => function ($kirby) {
        return [
            'debug' => kirby()->user() && kirby()->user()->role()->isAdmin()
        ];
    },
    'panel' => [
        'css' => 'assets/css/panel.css',
    ]
];
