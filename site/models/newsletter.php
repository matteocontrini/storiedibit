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

    public function likesReports()
    {
        $statsPath = $this->root() . '/likes.csv';

        if (!file_exists($statsPath)) {
            return [];
        }

        $blocks = $this->text()->toBlocks();

        $file = fopen($statsPath, 'r');

        $counts = [];

        while (($line = fgetcsv($file)) !== FALSE) {
            if (isset($counts[$line[0]])) {
                $counts[$line[0]]++;
            } else {
                $counts[$line[0]] = 1;
            }
        }

        fclose($file);

        $result = [];
        foreach ($counts as $id => $value) {
            $label = $blocks->find($id)->text();
            $result[] = ['label' => $label, 'value' => $value];
        }

        return $result;
    }

}
