<?php

use Kirby\Uuid\Uuid;
use Kirby\Cms\Page;

$config = [
    'debug' => false,
    'ready' => function (Kirby\Cms\App $kirby) {
        if (!vite()->isDev()) {
            header('Content-Security-Policy-Report-Only: default-src \'none\'; script-src-elem \'self\' gc.zgo.at; style-src-elem \'self\'; connect-src https://storiedibit.goatcounter.com/count; font-src \'self\'; img-src \'self\'; report-uri https://18375b7a0330ab8c626c8938b621ba46.report-uri.com/r/d/csp/reportOnly');
        }

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
        // Newsletter images
        [
            'pattern' => 'newsletter/(:any)/image/(:any)/(:alpha)',
            'action' => function ($id, $uuid, $size) {
                $page = page('newsletter')->findPageOrDraft($id);

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
        ],
        // Newletter like image
        [
            'pattern' => 'assets/email/like.png',
            'action' => function () {
                $size = 16 * 2;
                $url = asset('assets/like.png')->resize($size, $size)->url();
                go($url);
            }
        ],
        // Newsletter sources icons
        [
            'pattern' => 'assets/email/sources/(:any)',
            'action' => function ($icon) {
                $size = 16 * 2;
                $url = asset('assets/sources/' . $icon)->resize($size, $size)->url();
                go($url);
            }
        ],
        // Newsletter sections
        [
            'pattern' => 'newsletter/(:any)/(:num)-(:any)',
            'action' => function ($id, $num, $slug) {
                $page = page('newsletter')->findPageOrDraft($id);
                $blocks = $page->text()->toBlocks();

                $i = -1;
                $sectionCounter = 0;
                $start = -1;
                $end = -1;
                foreach ($blocks as $block) {
                    $i++;
                    $type = $block->type();
                    if ($start != -1) {
                        if ($type == 'newsletter-v2-section-header' || $type == 'newsletter-subscribe' || $type == 'line') {
                            $end = $i;
                            break;
                        } else if ($type == 'newsletter-sources') {
                            $end = $i + 1;
                            break;
                        }
                    } else if ($block->type() == 'newsletter-v2-section-header') {
                        $sectionCounter++;
                        if ($sectionCounter != $num) {
                            continue;
                        }
                        $start = $i;
                    }
                }

                $sectionBlocks = $blocks->slice($start, $end - $start);

                $titleBlock = $sectionBlocks->findBy('type', 'newsletter-v2-section-title');
                if ($titleBlock) {
                    $title = $titleBlock->text();
                } else {
                    return false;
                }

                $generatedSlug = $title->slug();
                if ($slug != $generatedSlug) {
                    go($page->url() . '/' . $num . '-' . $generatedSlug, 301);
                }

                return Page::factory([
                    'slug' => 'newsletter/' . $id . '/' . $num . '-' . $slug,
                    'template' => 'newsletter-section',
                    'model' => 'newsletter-section',
                    'content' => [
                        'uuid' => Uuid::generate(),
                        'title' => $title,
                        'date' => $page->title(),
                        'blocks' => $sectionBlocks->toJson(),
                    ]
                ]);
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
