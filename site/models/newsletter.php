<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;
use Kirby\Uuid\Uuid;

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

    public function children(): Pages
    {
        if ($this->children instanceof Pages) {
            return $this->children;
        }

        $pages = [];
        $blocks = $this->text()->toBlocks();

        $i = -1;
        $start = -1;
        foreach ($blocks as $block) {
            $i++;
            $type = $block->type();
            if ($start != -1) {
                if ($type == 'newsletter-v2-section-header' || $type == 'newsletter-subscribe' || $type == 'line') {
                    $end = $i;
                } else if ($type == 'newsletter-sources') {
                    $end = $i + 1;
                } else {
                    continue;
                }

                $sectionBlocks = $blocks->slice($start, $end - $start);
                $title = $sectionBlocks->findBy('type', 'newsletter-v2-section-title')->text();

                $pages[] = [
                    'slug' => Str::slug($title),
                    'template' => 'newsletter-section',
                    'model' => 'newsletter-section',
                    'content' => [
                        'uuid' => Uuid::generate(),
                        'title' => $title,
                        'date' => $this->title(),
                        'parentUrl' => $this->url(),
                        'blocks' => $sectionBlocks->toJson(),
                    ]
                ];

                $start = -1;
            } else if ($type == 'newsletter-v2-section-title') {
                $start = $i - 1;
            }
        }

        return $this->children = Pages::factory($pages, $this);
    }

}
