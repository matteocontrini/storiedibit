<?php

/** @var \Kirby\Cms\Block $block */
/** @var string $lastSubsectionBlockId */

$items = $block->sources()->toStructure();

?>

<div class="flex gap-x-2.5 gap-y-2 flex-wrap mt-4 mb-5">
    <a class="sources-pill"
       data-like-block-id="<?= $lastSubsectionBlockId ?>">
        <img src="<?= asset('assets/like.png')->url() ?>" alt="" class="w-4 h-4 rounded-sm">
        <span>
            Mi piace
        </span>
    </a>

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
