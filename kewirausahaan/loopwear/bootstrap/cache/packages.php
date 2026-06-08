<?php

return [
    'laravel/sail' => [
        'providers' => [
            'Laravel\\Sail\\SailServiceProvider',
        ],
    ],
    'laravel/sanctum' => [
        'providers' => [
            'Laravel\\Sanctum\\SanctumServiceProvider',
        ],
    ],
    'laravel/socialite' => [
        'aliases' => [
            'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
        ],
        'providers' => [
            'Laravel\\Socialite\\SocialiteServiceProvider',
        ],
    ],
    'laravel/tinker' => [
        'providers' => [
            'Laravel\\Tinker\\TinkerServiceProvider',
        ],
    ],
    'nesbot/carbon' => [
        'providers' => [
            'Carbon\\Laravel\\ServiceProvider',
        ],
    ],
    'nunomaduro/collision' => [
        'providers' => [
            'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
        ],
    ],
    'nunomaduro/termwind' => [
        'providers' => [
            'Termwind\\Laravel\\TermwindServiceProvider',
        ],
    ],
    'spatie/laravel-ignition' => [
        'aliases' => [
            'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare',
        ],
        'providers' => [
            'Spatie\\LaravelIgnition\\IgnitionServiceProvider',
        ],
    ],
];