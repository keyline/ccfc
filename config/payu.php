<?php

use Tzsk\Payu\Gateway\Gateway;
use Tzsk\Payu\Gateway\PayuBiz;
use Tzsk\Payu\Gateway\PayuMoney;
use Tzsk\Payu\Models\PayuTransaction;

return [
    'default' => env('PAYU_DEFAULT_GATEWAY', 'money'),

    'gateways' => [
        'money' => new PayuMoney([
            'mode' => env('PAYU_MONEY_MODE', Gateway::LIVE_MODE),
            'key' => env('PAYU_MONEY_KEY', 'Bg6kFX'),
            'salt' => env('PAYU_MONEY_SALT', 'iUf3jtDm'),
            'auth' => env('PAYU_MONEY_AUTH', 'default'),
        ]),

        'biz' => new PayuBiz([
            'mode' => env('PAYU_BIZ_MODE', Gateway::LIVE_MODE),
            'key' => env('PAYU_BIZ_KEY', 'JsaZRQ'),
            'salt' => env('PAYU_BIZ_SALT', 'g2U72sm8'),
        ]),
    ],

    'verify' => [
        PayuTransaction::STATUS_PENDING,
    ],
];
