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
        'x.com' => 'x.png',
        'news.ycombinator.com' => 'hackernews.png',
        'github.com' => 'github.png',
        'techcrunch.com' => 'techcrunch.png',
        'bloomberg.com' => 'bloomberg.png',
        'venturebeat.com' => 'venturebeat.png',
        'theverge.com' => 'theverge.png',
        'medium.com' => 'medium.png',
        'arstechnica.com' => 'arstechnica.png',
        'ilsole24ore.com' => 'ilsole24ore.png',
        'infodata.ilsole24ore.com' => 'ilsole24ore.png',
        '24plus.ilsole24ore.com' => 'ilsole24ore.png',
        'quotidiano.ilsole24ore.com' => 'ilsole24ore.png',
        'openai.com' => 'openai.png',
        'blog.cloudflare.com' => 'cloudflare.png',
        'nytimes.com' => 'nytimes.png',
        'wsj.com' => 'wsj.png',
        'ai.meta.com' => 'meta.png',
        'about.fb.com' => 'meta.png',
        'mistral.ai' => 'mistral.png',
        'hdblog.it' => 'hdblog.png',
        'ansa.it' => 'ansa.png',
        'news.microsoft.com' => 'microsoft.png',
        'mondomobileweb.it' => 'mondomobileweb.png',
        'hwupgrade.it' => 'hwupgrade.png',
        'ec.europa.eu' => 'europa.png',
        'milanofinanza.it' => 'milanofinanza.png',
        'italian.tech' => 'italiantech.png',
        't.me' => 'telegram.png',
        'restofworld.org' => 'restofworld.png',
        '9to5mac.com' => '9to5mac.png',
        'nature.com' => 'nature.png',
        'bleepingcomputer.com' => 'bleepingcomputer.png',
        'blog.google' => 'google.png',
        'vox.com' => 'vox.png',
        'corriere.it' => 'corrieredellasera.png',
        default => 'generic.png',
    };
}

