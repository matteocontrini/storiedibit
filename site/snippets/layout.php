<?php
/**
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 * @var Kirby\Cms\App $kirby
 * @var string $slot
 * @var string $title
 */

use Kirby\Toolkit\Str;

if ($page->isHomePage()) {
    $title = 'Storie di bit, una newsletter su Internet, AI, digitale';
} else if (isset($title)) {
    $title .= ' | ' . $site->title();
} else {
    $title = $site->title();
}

$title = Str::esc($title);

$templateName = $page->template()->name();

// TODO: use og:type article for articles

?>
<!DOCTYPE html>
<html lang="it" class="motion-safe:scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>

    <title><?= $title ?></title>

    <?= vite()->js('src/main.ts') ?>
    <?= vite()->css('src/main.ts') ?>

    <meta property="og:site_name" content="Storie di bit">
    <meta property="og:url" content="<?= $page->url() ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $title ?>">
    <?php if ($templateName != 'newsletter-section'): ?>
        <meta property="og:description"
              content="Una newsletter su Internet, AI e digitale: ogni weekend le dieci storie più interessanti della settimana.">
        <meta name="description"
              content="Una newsletter su Internet, AI e digitale: ogni weekend le dieci storie più interessanti della settimana.">
    <?php endif; ?>
    <meta property="og:image"
          content="<?= $templateName === 'newsletter' || $templateName === 'newsletter-section' ? $page->url() . '.png' : assetV('assets/opengraph.png') ?>">
    <meta property="twitter:card" content="summary_large_image">

    <link rel="canonical" href="<?= $page->url() ?>">

    <link rel="icon" href="<?= assetV('assets/favicon-32.png') ?>" type="image/png" sizes="32x32"/>
    <meta property="og:logo" content="<?= assetV('assets/favicon-500.png') ?>"/>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= assetV('assets/favicon-180.png') ?>"/>
</head>
<body>

<header>
    <div class="flex items-center justify-center w-[1100px] max-w-full mx-auto h-full py-4">
        <a href="<?= $site->url() ?>" class="font-semibold text-3xl">
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

<?php if (!$kirby->system()->isLocal()): ?>
    <script data-goatcounter="https://storiedibit.goatcounter.com/count" async
            src="https://gc.zgo.at/count.js"></script>
<?php endif; ?>

</body>
</html>
