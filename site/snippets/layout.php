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

    <?php if ($page->isHomePage()): ?>
        <meta property="og:site_name" content="Storie di bit">
        <meta property="og:url" content="https://storiedibit.it">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Storie di bit">
        <meta property="og:description"
              content="Una newsletter settimanale su Internet, intelligenza artificiale, reti, telecomunicazioni, digitale e cybersecurity.">
        <meta property="og:image" content="<?= asset('assets/opengraph.png')->url() ?>">
    <?php endif ?>
</head>
<body>

<header>
    <div class="flex items-center justify-center w-[1100px] max-w-full mx-auto h-full py-4">
        <a href="<?= $site->url() ?>" class="font-semibold text-3xl font-title">
            <img src="<?= asset('assets/logo.png')->resize(200 * 2)->url() ?>" alt="<?= $site->title() ?>" width="200">
        </a>
    </div>

    <hr/>
</header>

<?= $slot ?>

<hr class="my-20">

<footer class="container my-16">
    <p class="text-center text-sdb-gray-500 text-sm">
        Un progetto di <a class="underline" href="https://matteosonoio.it/it">Matteo Contrini</a>
        <br>

        <a href="https://t.me/notedimatteo" class="underline" target="_blank">Canale Telegram</a>
        •
        <a href="mailto:matteo@storiedibit.it">Email</a>
    </p>

    <p class="text-center text-sdb-gray-500 text-sm">
        © CC BY 4.0 - <a href="<?= page('credits')->url() ?>" class="underline">Credits</a>
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
