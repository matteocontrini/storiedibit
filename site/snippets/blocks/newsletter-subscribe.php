<?php /** @var \Kirby\Cms\Block $block */ ?>

<form method="post" action="<?= page('subscribe')->url() ?>"
      class="bg-accent rounded-lg p-10 my-14">
    <div class="absolute left-[-99999px]">
        <label for="name">Name</label>
        <input type="url" name="name" tabindex="-1">
    </div>

    <div class="flex flex-col gap-5 max-w-full">
        <h2 class="text-white my-0">
            Iscriviti alla newsletter
        </h2>

        <!-- TODO: can we avoid forcing? -->
        <p class="!my-0 text-white !text-lg">
            Non perderti le prossime uscite! Iscriviti alla newsletter per ricevere ogni weekend via email le storie più
            interessanti della settimana.
        </p>

        <div class="flex flex-col sm:flex-row gap-2 w-full">
            <input type="email" name="email" required placeholder="Il tuo indirizzo email..."
                   class="rounded-lg px-4 h-12 text-center w-full">
            <input type="submit" name="submit" value="Iscriviti"
                   class="bg-white w-full sm:w-fit rounded-lg px-10 h-12 uppercase font-semibold text-accent cursor-pointer">
        </div>

        <label for="privacy-<?= $block->id() ?>" class="text-fuchsia-200 self-start text-xs">
            <input type="checkbox" id="privacy-<?= $block->id() ?>" name="privacy" required>

            <span>
                Ho preso visione dell'<a href="<?= page('privacy')->url() ?>" class="underline">informativa sulla privacy</a>
                e acconsento al trattamento dei dati personali per l'invio della newsletter e la raccolta di statistiche.
                </span>
        </label>
    </div>
</form>
