<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<header class="mt-14 w-[1100px] max-w-full px-4 mx-auto">
    <?php if ($page->tags()->isNotEmpty()) : ?>
        <div class="flex flex-wrap gap-x-4 md:gap-x-5">
            <?php foreach ($page->tags()->split() as $tag) : ?>
                <span class="font-article-headline font-semibold text-2xl md:text-3xl text-sdb-<?= tagColor($tag) ?>">
                <?= tagName($tag) ?>
            </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <hr class="my-4 md:my-3">

    <h1 class="p-0 font-article-headline font-bold text-left text-5xl md:text-6xl leading-article-title">
        <?= $page->title() ?>
    </h1>

    <div class="font-article-headline text-2xl md:text-3xl mt-5 !leading-article-summary">
        <?= $page->summary() ?>
    </div>

    <div class="mt-5 uppercase flex flex-wrap gap-x-3 text-[15px]">
        <?php if ($page->authors()->isNotEmpty()) : ?>
            <span>
                di
                <?php
                $authors = $page->authors()->toUsers();
                foreach ($authors as $author) {
                    echo $author->name();
                }
                ?>
            </span>
            <span class="text-gray-200">
            |
            </span>
        <?php endif; ?>
        <span>
            <?= $page->date()->toDate('d MMM y') ?>
        </span>
        <span class="text-gray-200">
            |
        </span>
        <span>
            <?= $page->readingTime() ?> min. di lettura
        </span>
    </div>

    <hr class="mt-5">
</header>

<main class="container mt-12 article">
    <?= smartypants($page->text()->toBlocks()) ?>
</main>

<?php endslot() ?>
