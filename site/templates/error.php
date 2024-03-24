<?php

/** @var Kirby\Cms\App $kirby */

$code = $kirby->response()->code();

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <?php if ($code == 404): ?>
        <h1>
            Pagina non trovata
        </h1>

        <p class="text-center">
            Hmm, questa pagina non sembra esistere...
        </p>
    <?php else: ?>
        <h1>
            Errore
        </h1>

        <p class="text-center">
            Si è verificato un errore.
        </p>

        <p class="text-center">
            Se il problema persiste, contattaci.
        </p>
    <?php endif; ?>
</main>

<?php endslot() ?>
