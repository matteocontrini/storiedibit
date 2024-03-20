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
    <form method="post" action="<?= page('subscribe')->url() ?>"
          class="bg-accent rounded-lg p-10 mt-14">
        <div class="absolute left-[-99999px]">
            <label for="name">Name</label>
            <input type="url" id="name" name="name" tabindex="-1">
        </div>

        <div class="flex flex-col items-center gap-5 w-9/12 mx-auto max-w-full">
            <h2 class="text-white mt-0 mb-4">
                Iscriviti alla newsletter
            </h2>

            <input type="email" id="email" name="email" required placeholder="Il tuo indirizzo email..."
                   class="rounded-lg px-4 h-12 text-center w-full">

            <label for="privacy" class="text-white self-start text-sm">
                <input type="checkbox" id="privacy" name="privacy" required>

                <span>
                    Ho preso visione dell'<a href="" class="underline">informativa sulla privacy</a> e acconsento al trattamento dei dati personali per
                    l'invio della newsletter.
                </span>
            </label>

            <input type="submit" name="submit" value="Iscriviti"
                   class="bg-white w-full rounded-lg h-12 uppercase font-serif text-accent cursor-pointer">
        </div>
    </form>

    <a class="mt-16 block text-lg text-center underline" href="<?= page('newsletter')->url() ?>">
        Vai all'archivio
    </a>
</main>

<?php endslot() ?>
