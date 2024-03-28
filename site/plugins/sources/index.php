<?php

function urlToIconFileName(string $url)
{
    $domain = parse_url($url, PHP_URL_HOST);
    $domain = preg_replace('/^www\./', '', $domain);
    return match ($domain) {
        'ilpost.it' => 'ilpost.png',
        'rainews.it' => 'rainews.png',
        'wired.it' => 'wired.png',
        'wired.com' => 'wired.png',
        'dday.it' => 'dday.png',
        'digital-news.it' => 'digital-news.png',
        'corrierecomunicazioni.it' => 'corcom.png',
        'theregister.com' => 'theregister.png',
        'repubblica.it' => 'repubblica.png',
        'youtube.com' => 'youtube.png',
        'twitter.com' => 'x.png',
        'news.ycombinator.com' => 'hackernews.png',
        'github.com' => 'github.png',
        'techcrunch.com' => 'techcrunch.png',
        'bloomberg.com' => 'bloomberg.png',
        'venturebeat.com' => 'venturebeat.png',
        'theverge.com' => 'theverge.png',
        'medium.com' => 'medium.png',
        'arstechnica.com' => 'arstechnica.png',
        default => 'generic.png',
    };
}

