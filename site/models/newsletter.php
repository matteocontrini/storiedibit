<?php

use Kirby\Cms\Page;

class NewsletterPage extends Page
{
    public function kilobytes(): int
    {
        $blocks = $this->text()->toBlocks();

        // Go through the blocks, take the text of text blocks and count the characters
        $bytes = 0;
        foreach ($blocks as $block) {
            if ($block->type() === 'text') {
                $bytes += strlen($block->text());
            }
        }

        // Format as kilobytes, rounded
        $bytes = round($bytes / 1024);

        return $bytes;
    }

}
