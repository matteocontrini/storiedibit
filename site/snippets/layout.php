<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>

    <title>
        <?= $page->title() ?> | <?= $site->title() ?>
    </title>

    <!-- TODO: replace with local font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <?= css('assets/css/main.css') ?>
</head>
<body>

<div class="container">

    <header>
        <h1>
            <a href="<?= $site->url() ?>">
                <?= $site->title() ?>
            </a>
        </h1>

        <div class="text-center mt-2 font-mono">
            17 marzo 2024
        </div>
    </header>

    <hr class="my-14">

    <main>
        <?= $slot ?>
    </main>

    <hr class="my-14">

    <footer class="my-16">
        <p class="text-center text-gray-500 text-sm">
            © CC BY 4.0<br>
            Un progetto di <a class="underline" href="https://matteosonoio.it/it">Matteo Contrini</a>
            •
            <a href="https://t.me/notedimatteo" class="underline" target="_blank">Telegram</a>
        </p>
    </footer>

</div>

</body>
</html>
