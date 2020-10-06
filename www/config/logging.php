<?php

return [
    'default' => env('LOG_CHANNEL', 'stack'),
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'stdout'],
        ],
        'stdout' => [
            'driver' => 'stack',
            'channels' => ['stdout'],
        ],
    ],
];