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
    <h1>Fatto ✅</h1>

    <p class="text-center font-semibold">
        Hai messo mi piace, grazie!
    </p>
</main>

<?php endslot() ?>
