<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1 class="v2">
        <?= $page->title() ?>
    </h1>

    <?= $page->text()->smartypants() ?>
</main>

<?php endslot() ?>
