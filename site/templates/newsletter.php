<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1 class="pb-0">
        Le storie della settimana
    </h1>

    <div class="text-center mt-2 font-mono">
        <?= $page->title()->toDate('d MMMM y') ?>
    </div>

    <hr class="my-14">

    <div class="newsletter">
        <?= smartypants($page->text()->toBlocks()) ?>
    </div>

    <p class="font-mono text-center text-sm text-sdb-gray-500">
        &lt;/ in ~<?= $page->kilobytes() ?> kB &gt;
    </p>
</main>

<?php endslot() ?>
