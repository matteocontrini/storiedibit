<?php

/** @var \Kirby\Cms\Block $block */

$items = $block->sources()->toStructure();

?>

<div class="flex gap-x-2.5 gap-y-2 flex-wrap my-5">
    <?php foreach ($items as $item): ?>
        <?php
        $domain = parse_url($item->url(), PHP_URL_HOST);
        $domain = preg_replace('/^www\./', '', $domain);
        $icon = match ($domain) {
            'ilpost.it' => 'ilpost.png',
            'rainews.it' => 'rainews.png',
            'wired.it' => 'wired.png',
            'dday.it' => 'dday.png',
            'digital-news.it' => 'digital-news.png',
            'corrierecomunicazioni.it' => 'corcom.png',
            'theregister.com' => 'theregister.png',
            default => 'generic.svg',
        };
        $asset = asset('assets/sources/' . $icon)->resize(16 * 2, 16 * 2)->url();
        ?>
        <a class="bg-gray-200 px-2.5 py-1 rounded-lg text-sm font-semibold flex items-center gap-1.5"
           href="<?= $item->url() ?>" target="_blank" rel="nofollow noopener">
            <img src="<?= $asset ?>" alt="" class="w-4 h-4">

            <span>
                <?= $item->name() ?>
            </span>
        </a>
    <?php endforeach ?>
</div>
