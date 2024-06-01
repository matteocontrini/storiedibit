<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

$title = 'Archivio newsletter';

snippet('layout', ['title' => $title], slots: true);

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
                    <?= $newsletter->title()->toDate('d MMMM y') ?>
                </a>
            </h2>

            <div>
                <?php
                $blocks = $newsletter->text()->toBlocks();
                $isV2 = $blocks->findBy('type', 'newsletter-v2-section-header');
                if ($isV2) {
                    echo '<ul>';
                    foreach ($blocks as $block) {
                        if ($block->type() === 'newsletter-v2-section-title') {
                            $text = $block->text();
                            ?>
                            <li>
                                <?= $text ?>
                                <a href="<?= $newsletter->url() ?>/<?= $block->text()->slug() ?>">
                                    <img src="<?= asset('assets/sources/generic.png')->resize(16 * 2, 16 * 2)->url() ?>"
                                         alt="(apri)" class="w-4 h-4 inline mb-1">
                                </a>
                            </li>
                            <?php
                        }
                    }
                    echo '<li>e altro...</li>';
                    echo '</ul>';
                } else {
                    $text = $blocks->first();
                    if ($newsletter->title() == '2024-03-31') {
                        $text = $blocks->nth(2);
                    }
                    $text = preg_replace('#<a.*?>(.*?)</a>#i', '\1', smartypants($text));
                    echo $text;
                }
                ?>
            </div>
        </article>
    <?php endforeach; ?>
</main>

<?php endslot() ?>
