<?php

/** @var \Kirby\Cms\Block $block */
/** @var string $lastSubsectionBlockId */

$items = $block->sources()->toStructure();

?>

<div class="flex gap-x-2.5 gap-y-2 flex-wrap mt-4 mb-5">
    <a class="bg-sdb-gray-200 hover:bg-sdb-gray-300 transition-colors px-2.5 py-1 rounded-lg text-sm font-semibold flex items-center gap-1.5 cursor-pointer"
       data-like-block-id="<?= $lastSubsectionBlockId ?>">
        <img src="<?= asset('assets/like.svg')->url() ?>" alt="" class="w-4 h-4 rounded-sm">
        <span>
            Mi piace
        </span>
    </a>

    <?php foreach ($items as $item): ?>
        <?php
        $domain = parse_url($item->url(), PHP_URL_HOST);
        $domain = preg_replace('/^www\./', '', $domain);
        $icon = match ($domain) {
            'ilpost.it' => 'ilpost.png',
            'rainews.it' => 'rainews.png',
            'wired.it' => 'wired.png',
            'wired.com' => 'wired.png',
            'dday.it' => 'dday.png',
            'digital-news.it' => 'digital-news.png',
            'corrierecomunicazioni.it' => 'corcom.png',
            'theregister.com' => 'theregister.png',
            'repubblica.it' => 'repubblica.png',
            'youtube.com' => 'youtube.png',
            'twitter.com' => 'x.png',
            'news.ycombinator.com' => 'hackernews.png',
            'github.com' => 'github.png',
            'techcrunch.com' => 'techcrunch.png',
            'bloomberg.com' => 'bloomberg.png',
            'venturebeat.com' => 'venturebeat.png',
            'theverge.com' => 'theverge.png',
            'medium.com' => 'medium.png',
            'arstechnica.com' => 'arstechnica.png',
            default => 'generic.svg',
        };
        $asset = asset('assets/sources/' . $icon)->resize(16 * 2, 16 * 2)->url();
        ?>
        <a class="bg-sdb-gray-200 hover:bg-sdb-gray-300 transition-colors px-2.5 py-1 rounded-lg text-sm font-semibold flex items-center gap-1.5"
           href="<?= $item->url() ?>" target="_blank" rel="nofollow noopener">
            <img src="<?= $asset ?>" alt="" class="w-4 h-4 rounded-sm">

            <span>
                <?= $item->name() ?>
            </span>
        </a>
    <?php endforeach ?>
</div>
