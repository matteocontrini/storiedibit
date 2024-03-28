<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\App $kirby
 */

$kirby->user() && $kirby->user()->role()->isAdmin() || exit();

$blocks = $page->text()->toBlocks();

echo '<div style="font-family: sans-serif; font-size: 17px; line-height: 28px; width: 640px; margin: 0 auto;">';

foreach ($blocks as $block) {
    if ($block->type() === 'newsletter-section') {
        echo '<br><br><a href="#' . $block->text()->slug() . '">' . $block->text() . '</a>:<br>';
    } else if ($block->type() === 'newsletter-subsection') {
        echo '• ' . $block->text() . ' ';
    }
}

echo '</div>';
