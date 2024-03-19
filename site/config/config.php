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
    ],
    'routes' => [
        [
            'pattern' => '(:num)',
            'action' => function ($num) {
                $page = page('newsletter')->children()->findBy('num', $num);
                if ($page) {
                    go($page->url());
                }

                $this->next();
            }
        ]
    ]
];
