<?php

/**
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

use Kirby\Toolkit\Str;

$title = $page->title();
$blocks = $page->blocks()->toBlocks();
$excerpt = Str::excerpt($blocks->findBy('type', 'text'));
$date = $page->date()->toDate('y-MM-dd');

snippet('layout', ['title' => $title, 'excerpt' => $excerpt, 'date' => $date], slots: true);

slot();

?>

<main class="container">
    <div class="mt-14 text-lg font-medium">
        Dalla newsletter del <?= $page->date()->toDate('d MMMM y') ?>.
        <a href="<?= $page->parentUrl() ?>" class="underline">Leggila qua</a>.
    </div>

    <div class="newsletter v2">
        <?php
        foreach ($blocks as $block) {
            echo smartypants($block);
        }
        ?>
    </div>

    <hr class="my-10">

    <p class="font-semibold">Dalla stessa newsletter puoi leggere anche:</p>

    <ul>
        <?php foreach ($page->parent()->children() as $section): ?>
            <?php if ($section->slug() != $page->slug()) : ?>
                <li>
                    <a href="<?= $section->url() ?>"><?= $section->title() ?></a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>

</main>

<?php endslot() ?>
