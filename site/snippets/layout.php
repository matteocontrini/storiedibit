<?php
/**
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 * @var string $slot
 */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>

    <title><?= $site->title() ?></title>

    <?= vite()->js('src/main.ts') ?>
    <?= vite()->css('src/main.ts') ?>
</head>
<body>

<div class="container">

    <?= $slot ?>

    <hr class="my-14">

    <footer class="my-16">
        <p class="text-center text-gray-500 text-sm">
            © CC BY 4.0<br>
            Un progetto di <a class="underline" href="https://matteosonoio.it/it">Matteo Contrini</a>
            •
            <a href="https://t.me/notedimatteo" class="underline" target="_blank">Canale Telegram</a>
        </p>
    </footer>

</div>

</body>
</html>
