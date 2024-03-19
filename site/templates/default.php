<?php

/** @var Kirby\Cms\Page $page */

snippet('layout', slots: true);

slot();

?>

<header>
    <h1>
        <a href="<?= $site->url() ?>">
            <?= $site->title() ?>
        </a>
    </h1>
</header>

<hr class="my-14">

<main>
    <a class="block font-serif text-3xl text-center" href="<?= page('newsletter')->url() ?>">
        Vai all'archivio
    </a>
</main>

<?php endslot() ?>
