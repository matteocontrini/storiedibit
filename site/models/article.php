<?php

use Kirby\Cms\Page;

class ArticlePage extends Page
{
    public function url($options = null) : string
    {
        return $this->url = $this->kirby()->url('base') . '/articoli/' . $this->date()->toDate('y/LL/') . $this->slug() . '-' . $this->uuid()->id();
    }

    public function readingTime() : int
    {
        // TODO: go through blocks text content
        $blocks = $this->text()->toBlocks()->toString();
        $words = str_word_count($blocks);
        return ceil($words / 200);
    }

}
