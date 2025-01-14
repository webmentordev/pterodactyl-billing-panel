<?php

return [
    'meta' => [
        'defaults'       => [
            'title'        => "RustDedicated Hosting",
            'titleBefore'  => false,
            'description'  => 'Rent high-performance Rust server hosting for under $25, with dedicated hardware, 4.40 GHz Processor, 60+ GB storage, 15 GB DDR4 RAM, support for unlimited player slots, the Rust+ app, and integrated RCON.',
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => null,
            'robots'       => 'all'
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'RustDedicated Hosting',
            'description' => 'Rent high-performance Rust server hosting for under $25, with dedicated hardware, 4.40 GHz Processor, 60+ GB storage, 15 GB DDR4 RAM, support for unlimited player slots, the Rust+ app, and integrated RCON.',
            'url'         => null,
            'type'        => false,
            'site_name'   => false,
            'images'      => [
                config('app.url') . '/assets/rustdedicated-hosting-banner.png',
                config('app.url') . '/assets/rust-dedicated-header-2'
            ],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card'        => 'large_summary',
            'site'        => '@rustdedicatedhosting',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'RustDedicated Hosting',
            'description' => 'Rent high-performance Rust server hosting for under $25, with dedicated hardware, 4.40 GHz Processor, 60+ GB storage, 15 GB DDR4 RAM, support for unlimited player slots, the Rust+ app, and integrated RCON.',
            'url'         => null,
            'type'        => 'WebPage',
            'images'      => [
                config('app.url') . '/assets/rustdedicated-hosting-banner.png',
                config('app.url') . '/assets/rust-dedicated-header-2'
            ],
        ],
    ],
];
