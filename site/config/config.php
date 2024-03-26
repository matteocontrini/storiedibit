<?php

$config = [
    'debug' => false,
    'ready' => function (Kirby\Cms\App $kirby) {
        return [
            'debug' => $kirby->user() && $kirby->user()->role()->isAdmin(),
            'panel' => [
                'css' => vite()->panelCss('src/panel.css'),
                'js' => vite()->panelJs(),
            ]
        ];
    },
    'date' => [
        'handler' => 'intl'
    ],
    'locale' => 'it_IT.utf-8',
    'routes' => [
        // Newsletter short links
        [
            'pattern' => '(:num)',
            'action' => function ($num) {
                $page = page('newsletter')->children()->findBy('num', $num);
                if ($page) {
                    go($page->url());
                }

                $this->next();
            }
        ],
        // Custom route for articles
        [
            'pattern' => 'articoli/(:num)/(:num)/(:any)-(:alphanum)',
            'action' => function ($year, $month, $slug, $uuid) {
                $page = page('articles')->find('page://' . $uuid);
                if ($page) {
                    if ($page->slug() != $slug) {
                        go($page->url(), 301);
                    }
                    return $page;
                }

                return false;
            }
        ],
        // Disable default articles route
        [
            'pattern' => 'articles/(:any)',
            'action' => function ($slug) {
                return false;
            }
        ],
        // Newsletter like
        [
            'pattern' => 'newsletter/(:any)/like/(:any)',
            'method' => 'GET|POST',
            'action' => function ($id, $blockUuid) {
                $page = page('newsletter/' . $id);

                if (!$page) {
                    return false;
                }

                $block = $page->text()->toBlocks()->find($blockUuid);

                if (!$block || $block->type() !== 'newsletter-subsection') {
                    return false;
                }

                // Append a line with block uuid and current date
                $statsPath = $page->root() . '/likes.csv';
                file_put_contents($statsPath, $blockUuid . ',' . time() . PHP_EOL, FILE_APPEND | LOCK_EX);

                if (kirby()->request()->is('POST')) {
                    return [
                        'status' => 'ok'
                    ];
                } else {
                    return page('liked');
                }
            }
        ],
        // Newsletter images
        [
            'pattern' => 'newsletter/(:any)/image/(:any)/(:alpha)',
            'action' => function ($id, $uuid, $size) {
                $page = page('newsletter/' . $id);

                if (!$page) {
                    return false;
                }

                $image = $page->files()->find('file://' . $uuid);

                if (!$image) {
                    return false;
                }

                if ($size == 'preview') {
                    $url = $image->resize(640 * 2)->url();
                } else {
                    $url = $image->url();
                }

                go($url);
            }
        ]
    ],
    'thathoff.git-content.commitMessage' => '[content] :action: :item: `:url:`'
];

$secrets = include __DIR__ . '/secrets.php';

if (is_array($secrets)) {
    $config = array_merge($config, $secrets);
}

return $config;
