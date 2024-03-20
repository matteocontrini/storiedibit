<?php

use Kirby\Http\Remote;
use Kirby\Toolkit\V;

return function (Kirby\Cms\App $kirby) {
    if (!$kirby->request()->is('POST') || !get('submit')) {
        $kirby->response()->code(404);
        exit();
    }

    // Check the honeypot
    if (empty(get('name')) === false) {
        $kirby->response()->code(404);
        exit();
    }

    if (get('privacy') != 'on') {
        return [
            'success' => false,
        ];
    }

    $email = get('email');

    if (empty($email) === true || V::email($email) === false) {
        return [
            'success' => false,
            'invalid' => true,
        ];
    }

    $list_id = option('emailoctopus.list_id');
    $api_key = option('emailoctopus.api_key');

    try {
        $response = new Remote("https://emailoctopus.com/api/1.6/lists/$list_id/contacts", [
            'method' => 'POST',
            'data' => [
                'api_key' => $api_key,
                'email_address' => $email,
            ]
        ]);

        if ($response->code() === 200) {
            return [
                'success' => true,
            ];
        }

        $payload = $response->json();

        if ($payload['error']['code'] == 'MEMBER_EXISTS_WITH_EMAIL_ADDRESS') {
            $resubscribed = resubscribe($email, $list_id, $api_key);
            if ($resubscribed) {
                return [
                    'success' => true,
                ];
            }
        }

        if (option('debug')) {
            die($response->content());
        }
    } catch (Exception $error) {
        if (option('debug')) {
            die($error->getMessage());
        }
    }

    return [
        'success' => false,
    ];
};

function resubscribe($email, $list_id, $api_key): bool
{
    $hash = md5(strtolower($email));

    try {
        $response = new Remote("https://emailoctopus.com/api/1.6/lists/$list_id/contacts/$hash", [
            'method' => 'PUT',
            'data' => [
                'api_key' => $api_key,
                'status' => 'PENDING',
            ]
        ]);
    } catch (Exception $error) {
        if (option('debug')) {
            die($error->getMessage());
        }

        return false;
    }

    return $response->code() === 200;
}
