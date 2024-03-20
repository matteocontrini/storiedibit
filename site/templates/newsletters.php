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
</header>

<hr class="my-14">

<main>
    <?php foreach (page('newsletter')->children()->listed()->sortBy('num', 'desc') as $newsletter): ?>
        <article>
            <h2>
                <a href="<?= $newsletter->url() ?>">
                    <?= $newsletter->title() ?>
                </a>
            </h2>
            <p>
                <?= $newsletter->text()->toBlocks()->first() ?>
            </p>
            <a href="<?= $newsletter->url() ?>" class="underline">
                Leggi tutto
            </a>
        </article>
    <?php endforeach; ?>
</main>

<?php endslot() ?>
