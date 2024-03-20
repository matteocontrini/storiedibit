<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */
/** @var bool $success */
/** @var bool $invalid */

snippet('layout', slots: true);

slot();

?>

<header>
    <h1>
        <a href="<?= $site->url() ?>">
            <?= $site->title() ?>
        </a>
    </h1>
</header>

<hr class="my-14">

<main>

    <?php if ($success): ?>
        <p class="text-center font-semibold">
            🚀 Grazie per esserti iscritto/a!
        </p>

        <p class="text-center">
            A breve riceverai un'email con un link di conferma.
        </p>
    <?php elseif (isset($invalid) && $invalid): ?>
        <p class="text-center font-semibold">
            🤔 L'indirizzo email inserito non è valido.
        </p>
        <p class="text-center">
            Torna indietro e riprova.
        </p>
    <?php else: ?>
        <p class="text-center font-semibold">
            ⚠️ Si è verificato un errore. Torna indietro e riprova.
        </p>
    <?php endif ?>


</main>

<?php endslot() ?>
