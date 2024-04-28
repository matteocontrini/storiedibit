<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

$title = $page->title();

snippet('layout', ['title' => $title], slots: true);

slot();

?>

<main class="container">
    <div class="mt-14 text-lg font-medium">
        Dalla newsletter del <?= $page->date()->toDate('d MMMM y') ?>.
        <a href="<?= $page->parentUrl() ?>" class="underline">Leggila qua</a>.
    </div>

    <div class="newsletter v2">
        <?php
        foreach ($page->blocks()->toBlocks() as $block) {
            echo smartypants($block);
        }
        ?>
    </div>

</main>

<?php endslot() ?>
