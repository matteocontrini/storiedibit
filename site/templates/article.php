<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<header class="mt-14 w-[1100px] mx-auto">
    <div class="flex gap-x-5">
        <span class="font-article-headline font-semibold text-3xl text-sdb-red">Reti</span>
        <span class="font-article-headline font-semibold text-3xl text-sdb-brown">Cybersecurity</span>
    </div>

    <hr class="my-4">

    <h1 class="p-0 font-article-headline font-extrabold text-left text-[64px] leading-[70px]">
        <?= $page->title() ?>
    </h1>

    <div class="font-article-headline text-[32px] mt-5 leading-snug">
        <?= $page->summary() ?>
    </div>

    <div class="mt-5 uppercase flex gap-x-3 text-[15px]">
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
