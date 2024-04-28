<?php
/**
 * @var \Kirby\Cms\Block $block
 * @var \Kirby\Cms\Page $page
 */
?>

<h2 id="<?= $block->text()->slug() ?>">
    <a href="<?= $page->url() ?>/<?= $block->text()->slug() ?>">
        <?= $block->text() ?>
    </a>
</h2>
