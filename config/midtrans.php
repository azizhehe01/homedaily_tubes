<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),
    'is_sanitized' => true, // Optional, set to true for sanitization
    'is_3ds' => true,
    'snap_url' => env('MIDTRANS_IS_PRODUCTION', false) ?
        'https://app.midtrans.com/snap/snap.js' :
        'https://app.sandbox.midtrans.com/snap/snap.js', // Optional, set to true for 3D Secure
];
