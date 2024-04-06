<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\App $kirby
 */

$kirby->user() && $kirby->user()->role()->isAdmin() || exit();

$blocks = $page->text()->toBlocks();

echo '<div style="font-family: sans-serif; font-size: 17px; line-height: 28px; width: 640px; margin: 70px auto;">';

$subsections = [];

foreach ($blocks as $block) {
    if ($block->type() === 'newsletter-section') {
        if (!empty($subsections)) {
            for ($i = 0; $i < count($subsections); $i++) {
                echo '• ' . $subsections[$i] . ($i === count($subsections) - 1 ? '' : ' ');
            }
            $subsections = [];
            echo '</p>';
        }

        $url = $page->url() . '#' . $block->text()->slug();
        echo '<p><a href="' . $url . '">' . $block->text() . '</a>:<br>';
    } else if ($block->type() === 'newsletter-subsection') {
        $subsections[] = $block->text();
    }
}

if (!empty($subsections)) {
    for ($i = 0; $i < count($subsections); $i++) {
        echo '• ' . $subsections[$i] . ($i === count($subsections) - 1 ? '' : ' ');
    }
    echo '</p>';
}

echo '</div>';
