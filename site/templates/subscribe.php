<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */
/** @var bool $success */
/** @var bool $invalid */
/** @var bool $exists */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1>Iscrizione newsletter</h1>

    <?php if ($success): ?>
        <p class="font-semibold">
            🚀 Grazie per esserti iscritto/a!
        </p>

        <p>
            A breve riceverai un'email con un link di conferma.
        </p>

        <p class="text-sm mt-6">
            Se non ricevi l'email, controlla in spam o <a href="mailto:matteo@storiedibit.it">contattaci</a>.
        </p>
    <?php elseif (isset($invalid) && $invalid): ?>
        <p class="font-semibold">
            🤔 L'indirizzo email inserito non è valido.
        </p>
        <p>
            Torna indietro e riprova.
        </p>
    <?php elseif (isset($exists) && $exists): ?>
        <p class="font-semibold">
            🤔 L'indirizzo email inserito è già presente nella nostra lista.
        </p>
        <p>
            Se non ricevi le email, <a href="mailto:matteo@storiedibit.it">contattaci</a>.
        </p>
    <?php else: ?>
        <p class="font-semibold">
            ⚠️ Si è verificato un errore. Torna indietro e riprova.
        </p>

        <p>
            Se non riesci a iscriverti, <a href="mailto:matteo@storiedibit.it">contattaci</a>.
        </p>
    <?php endif ?>


</main>

<?php endslot() ?>
