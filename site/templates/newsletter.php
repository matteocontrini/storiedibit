<?php

/** @var Kirby\Cms\Page $page */

snippet('layout', slots: true);

slot();

?>

<?= $page->text()->toBlocks() ?>

<?php endslot() ?>

