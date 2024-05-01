<?php
/** @var \Kirby\Cms\Block $block */
/** @var int $number */
?>

<hr>

<span class="uppercase font-bold py-1 text-sm text-center tracking-wide">
    <?= $block->text() ?>
</span>

<?php if (isset($number)): ?>
    <div class="rounded-full bg-accent w-10 h-10 text-white flex items-center justify-center font-semibold mt-3 mb-5">
        <?= $number ?>
    </div>
<?php endif; ?>
