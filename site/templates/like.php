<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */
/** @var string $pageId */
/** @var string $blockId */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1>Fatto ✅</h1>

    <p class="text-center font-semibold">
        Hai messo mi piace, grazie!
    </p>
</main>

<script>
    fetch('/newsletter/<?= $pageId ?>/like/<?= $blockId ?>', {method: 'POST'})
        .then((response) => {
            if (!response.ok) {
                alert('Si è verificato un errore.');
            }
        })
        .catch(() => {
            alert('Si è verificato un errore.');
        });
</script>

<?php endslot() ?>
