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

            <div>
                <?php
                $blocks = $newsletter->text()->toBlocks();
                $text = $blocks->first();
                if ($newsletter->title() == '2024-03-31') {
                    $text = $blocks->nth(2);
                }
                $text = preg_replace('#<a.*?>(.*?)</a>#i', '\1', smartypants($text));
                echo $text;
                ?>
            </div>

            <a href="<?= $newsletter->url() ?>" class="underline">
                Leggi tutto
            </a>
        </article>
    <?php endforeach; ?>
</main>

<?php endslot() ?>
