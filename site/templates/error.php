<?php

/** @var Kirby\Cms\App $kirby */

$code = $kirby->response()->code();

snippet('layout', ['title' => 'Errore'], slots: true);

slot();

?>

<main class="container">
    <?php if ($code == 404): ?>
        <h1>
            Pagina non trovata
        </h1>

        <p>
            Hmm, questa pagina non sembra esistere...
        </p>
    <?php else: ?>
        <h1>
            Errore
        </h1>

        <p>
            Si è verificato un errore.
        </p>

        <p>
            Se il problema persiste, contattaci.
        </p>
    <?php endif; ?>
</main>

<?php endslot() ?>
