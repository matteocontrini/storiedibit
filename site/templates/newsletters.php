<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1>
        Archivio newsletter
    </h1>

    <hr class="mb-14">

    <?php foreach (page('newsletter')->children()->listed()->sortBy('num', 'desc') as $newsletter): ?>
        <article>
            <h2>
                <a href="<?= $newsletter->url() ?>" class="underline">
                    <?= $newsletter->title() ?>
                </a>
            </h2>
            <p>
                <?= preg_replace('#<a.*?>(.*?)</a>#i', '\1', smartypants($newsletter->text()->toBlocks()->first())) ?>
            </p>
            <a href="<?= $newsletter->url() ?>" class="underline">
                Leggi tutto
            </a>
        </article>
    <?php endforeach; ?>
</main>

<?php endslot() ?>
