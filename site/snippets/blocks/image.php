<?php

/** @var \Kirby\Cms\Block $block */

use Kirby\Toolkit\Str;

$alt = $block->alt();
$caption = $block->caption();

if ($block->location() == 'web') {
    $src = $url = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    $src = $image->resize(640 * 2)->url();
    $url = $image->url();
}

if ($block->link()->isNotEmpty()) {
    $url = Str::esc($block->link()->toUrl());
}

?>
<figure>
    <a href="<?= $url ?>" target="_blank">
        <img src="<?= $src ?>" alt="<?= $alt ?>" loading="lazy" class="rounded-lg">
    </a>

    <?php if ($caption->isNotEmpty()): ?>
        <figcaption>
            <?= $caption ?>
        </figcaption>
    <?php endif ?>
</figure>
