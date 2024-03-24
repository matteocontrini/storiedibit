<?php

/** @var Kirby\Cms\Page $page */
/** @var Kirby\Cms\Site $site */

snippet('layout', slots: true);

slot();

?>

<main class="container">
    <h1 class="pb-0">
        Le storie della settimana
    </h1>

    <div class="text-center mt-2 font-mono">
        <?= $page->title()->toDate('d MMMM y') ?>
    </div>

    <hr class="my-14">

    <div class="newsletter">
        <?php
        $lastSubsectionBlockId = null;
        foreach ($page->text()->toBlocks() as $block) {
            if ($block->type() === 'newsletter-subsection') {
                $lastSubsectionBlockId = $block->id();
            }

            if ($block->type() === 'newsletter-sources') {
                echo snippet('blocks/newsletter-sources', ['block' => $block, 'lastSubsectionBlockId' => $lastSubsectionBlockId]);
            } else {
                echo smartypants($block);
            }
        }
        ?>
    </div>

    <p class="font-mono text-center text-sm text-sdb-gray-500">
        &lt;/ in ~<?= $page->kilobytes() ?> kB &gt;
    </p>
</main>

<script>
    document.querySelectorAll('[data-like-block-id]').forEach((element) => {
        element.addEventListener('click', () => {
            if (element.classList.contains('selected')) {
                return;
            }

            const blockId = element.getAttribute('data-like-block-id');
            element.classList.add('selected');

            fetch('<?= page()->url() ?>/like/' + blockId, {
                method: 'POST',
            });
        });
    });
</script>

<?php endslot() ?>
