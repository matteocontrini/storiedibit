<?php

$config = [
    'debug' => false,
    'ready' => function ($kirby) {
        return [
            'debug' => kirby()->user() && kirby()->user()->role()->isAdmin()
        ];
    },
    'panel' => [
        'css' => 'assets/css/panel.css',
    ],
    'date' => [
        'handler' => 'intl'
    ],
    'locale' => 'it_IT.utf-8',
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
    ],
    'thathoff.git-content.commitMessage' => 'Content: :action: :item: `:url:`'
];

$secrets = include __DIR__ . '/secrets.php';

if (is_array($secrets)) {
    $config = array_merge($config, $secrets);
}

return $config;
