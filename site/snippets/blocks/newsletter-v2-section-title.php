<?php
/**
 * @var \Kirby\Cms\Block $block
 * @var \Kirby\Cms\Page $page
 */

$link = $page->template() == 'newsletter';
?>

<h2 id="<?= $block->text()->slug() ?>">
    <?php if ($link): ?>
        <a href="<?= $page->url() ?>/<?= $block->text()->slug() ?>">
            <?= $block->text() ?>
            <img src="<?= asset('assets/sources/generic.png')->resize(16 * 2, 16 * 2)->url() ?>"
                 alt="" class="w-4 h-4 inline">
        </a>
    <?php else: ?>
        <?= $block->text() ?>
    <?php endif ?>
</h2>
