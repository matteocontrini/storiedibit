<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

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
    <p class="text-center">
        <strong>Storie di bit</strong> è una newsletter settimanale su Internet, intelligenza artificiale, reti,
        telecomunicazioni, digitale e cybersecurity.
    </p>

    <p class="text-center">
        Ogni weekend racconto e spiego le storie più interessanti della settimana, sia italiane che internazionali. Puoi
        iscriverti qua sotto, è gratis!
    </p>

    <form method="post" action="<?= page('subscribe')->url() ?>"
          class="bg-accent rounded-lg p-10 my-14">
        <div class="absolute left-[-99999px]">
            <label for="name">Name</label>
            <input type="url" id="name" name="name" tabindex="-1">
        </div>

        <div class="flex flex-col items-center gap-5 max-w-full">
            <h2 class="text-white mt-0 mb-4 text-center">
                Iscriviti alla newsletter
            </h2>

            <div class="flex flex-col sm:flex-row gap-2 w-full">
                <input type="email" id="email" name="email" required placeholder="Il tuo indirizzo email..."
                       class="rounded-lg px-4 h-12 text-center w-full">
                <input type="submit" name="submit" value="Iscriviti"
                       class="bg-white w-full sm:w-fit rounded-lg px-10 h-12 uppercase font-serif text-accent cursor-pointer">
            </div>

            <label for="privacy" class="text-fuchsia-200 self-start text-xs">
                <input type="checkbox" id="privacy" name="privacy" required>

                <span>
                Ho preso visione dell'<a href="<?= page('privacy')->url() ?>" class="underline">informativa sulla privacy</a>
                e acconsento al trattamento dei dati personali per l'invio della newsletter e la raccolta di statistiche.
                </span>
            </label>
        </div>
    </form>

    <a class="mt-16 block text-lg text-center underline" href="<?= page('newsletter')->url() ?>">
        Vai all'archivio
    </a>
</main>

<?php endslot() ?>
