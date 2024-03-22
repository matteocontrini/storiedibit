<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<header>
    <h1>
        <a href="<?= $site->url() ?>">
            <?= $site->title() ?>
        </a>
    </h1>

    <div class="text-center mt-2 font-mono">
        <?= $page->title()->toDate('d MMMM y') ?>
    </div>
</header>

<hr class="my-14">

<main>
    <?= smartypants($page->text()->toBlocks()) ?>
</main>

<?php endslot() ?>
