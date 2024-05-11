<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\App $kirby
 */

use Kirby\Http\Remote;

$kirby->user() && $kirby->user()->role()->isAdmin() || exit();

$blocks = $page->text()->toBlocks();

$emojis = ['1️⃣', '2️⃣', '3️⃣', '4️⃣', '5️⃣', '6️⃣', '7️⃣', '8️⃣', '9️⃣', '🔟'];

$text = '';
$n = 0;
foreach ($blocks as $block) {
    if ($block->type() === 'newsletter-v2-section-title') {
        $url = $page->url();
        $text .= $emojis[$n] . ' <i>' . htmlspecialchars($block->text()) . '</i> [<a href="' . $url . "\">link</a>]\n\n";
        $n++;
    }
}

echo $text;

$chat_id = option('telegram.chat_id');
$token = option('telegram.token');

$response = new Remote("https://api.telegram.org/bot$token/sendMessage", [
    'method' => 'POST',
    'data' => [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
    ]
]);

echo $response->content();
