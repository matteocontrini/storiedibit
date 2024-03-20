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

    <!-- TODO: replace with local font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- TODO: maybe vite? -->
    <?= css('assets/css/main.css') ?>
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
