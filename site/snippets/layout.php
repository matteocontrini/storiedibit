<?php
/**
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 * @var string $slot
 */
?>
<!DOCTYPE html>
<html lang="it" class="motion-safe:scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>

    <title><?= $site->title() ?></title>

    <?= vite()->js('src/main.ts') ?>
    <?= vite()->css('src/main.ts') ?>
</head>
<body>

<header>
    <div class="flex items-center justify-center w-[1100px] max-w-full mx-auto h-full py-4">
        <a href="<?= $site->url() ?>" class="font-semibold text-3xl font-article-headline">storie di bit</a>
    </div>

    <hr class="border-t-2"/>
</header>

<?= $slot ?>

<hr class="my-20">

<footer class="container my-16">
    <p class="text-center text-sdb-gray-500 text-sm">
        © CC BY 4.0<br>
        Un progetto di <a class="underline" href="https://matteosonoio.it/it">Matteo Contrini</a>
        <br>

        <a href="https://t.me/notedimatteo" class="underline" target="_blank">Canale Telegram</a>
        •
        <a href="mailto:matteo@storiedibit.it">Email</a>
    </p>
</footer>

<script>
    if (window.location.host !== 'storiedibit.it') {
        window.goatcounter = {no_onload: true};
    }
</script>
<script data-goatcounter="https://storiedibit.goatcounter.com/count" async src="https://gc.zgo.at/count.js"></script>

</body>
</html>
