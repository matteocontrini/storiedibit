<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1 class="v2">
        Archivio newsletter
    </h1>

    <hr class="mb-14">

    <?php foreach (page('newsletter')->children()->listed()->sortBy('num', 'desc') as $newsletter): ?>
        <article>
            <h2 class="v2 !mt-16 !mb-8">
                <a href="<?= $newsletter->url() ?>" class="underline">
                    <?= $newsletter->title()->toDate('d MMMM y') ?>
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
        </article>
    <?php endforeach; ?>
</main>

<?php endslot() ?>
