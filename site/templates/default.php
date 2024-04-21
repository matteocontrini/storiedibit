<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', ['title' => $page->title()], slots: true);

slot();

?>

<main class="container">
    <h1>
        <?= $page->title() ?>
    </h1>

    <?= $page->text()->smartypants() ?>
</main>

<?php endslot() ?>
