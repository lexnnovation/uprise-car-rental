<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => env('APP_NAME', 'Uprise') . ' — Premium Chauffeur & Transportation Services in Ghana',
            'titleBefore'  => false,
            'description'  => 'Premium chauffeur, airport transfer, executive, safari and group transportation across Ghana and West Africa. Professional drivers, modern fleet, concierge service.',
            'separator'    => ' | ',
            'keywords'     => ['Ghana chauffeur', 'Accra airport transfer', 'executive transportation Ghana', 'safari transport', 'car with driver Ghana', 'West Africa transportation'],
            'canonical'    => 'full',
            'robots'       => 'index,follow',
        ],
        /*
         * Webmaster tags are always added.
         */
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
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => env('APP_NAME', 'Uprise') . ' — Premium Chauffeur & Transportation in Ghana',
            'description' => 'Premium chauffeur, airport transfer and executive transportation across Ghana and West Africa.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => env('APP_NAME', 'Uprise'),
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card' => 'summary_large_image',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => env('APP_NAME', 'Uprise') . ' — Premium Chauffeur & Transportation in Ghana',
            'description' => 'Premium chauffeur, airport transfer and executive transportation across Ghana and West Africa.',
            'url'         => 'full',
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
