<?php

/** @var \Kirby\Cms\Block $block */

$items = $block->sources()->toStructure();

?>

<div class="flex gap-x-2.5 gap-y-2 flex-wrap my-5">
    <?php foreach ($items as $item): ?>
        <?php
        $icon = urlToIconFileName($item->url());
        $asset = asset('assets/sources/' . $icon)->resize(16 * 2, 16 * 2)->url();
        ?>
        <a class="sources-pill"
           href="<?= $item->url() ?>" target="_blank" rel="nofollow noopener">
            <img src="<?= $asset ?>" alt="" class="w-4 h-4 rounded-sm">

            <span>
                <?= $item->name() ?>
            </span>
        </a>
    <?php endforeach ?>
</div>
