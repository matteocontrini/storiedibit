<?php /** @var \Kirby\Cms\Block $block */ ?>

<h2 id="<?= $block->text()->slug() ?>" class="text-center text-sdb-<?= $block->color() ?>"><?= $block->text() ?></h2>
