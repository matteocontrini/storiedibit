<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

$isv2 = $page->title()->toDate() > 1713511388;

?>

<main class="container">
    <h1 class="pb-0">
        Le storie della settimana
    </h1>

    <div class="mt-3 text-lg font-semibold">
        <?= $page->title()->toDate('d MMMM y') ?>
    </div>

    <hr class="my-12">

    <?php if ($isv2) : ?>
        <div class="newsletter v2">
            <?php
            $n = 0;
            $skipNext = false;
            foreach ($page->text()->toBlocks() as $block) {
                if ($skipNext) {
                    $skipNext = false;
                    continue;
                }
                if ($block->type() === 'newsletter-v2-section-header') {
                    $n++;
                    echo snippet('blocks/newsletter-v2-section-header', ['block' => $block, 'number' => $n]);
                } else if ($block->type() === 'newsletter-only-email') {
                    $skipNext = true;
                } else {
                    echo smartypants($block);
                }
            }
            ?>
        </div>
    <?php else : ?>
        <div class="newsletter v1">
            <?php
            // TODO: not needed anymore
            $lastSubsectionBlockId = null;
            foreach ($page->text()->toBlocks() as $block) {
                if ($block->type() === 'newsletter-subsection') {
                    $lastSubsectionBlockId = $block->id();
                }

                if ($block->type() === 'newsletter-sources') {
                    echo snippet('blocks/newsletter-sources', ['block' => $block, 'lastSubsectionBlockId' => $lastSubsectionBlockId]);
                } else {
                    echo smartypants($block);
                }
            }
            ?>
        </div>

        <p class="font-mono text-center text-sm text-sdb-gray-500">
            &lt;/ in ~<?= $page->kilobytes() ?> kB &gt;
        </p>
    <?php endif; ?>
</main>

<?php endslot() ?>
