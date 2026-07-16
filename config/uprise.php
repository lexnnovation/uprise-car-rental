<?php

/*
|--------------------------------------------------------------------------
| Uprise Application Configuration
|--------------------------------------------------------------------------
|
| App-specific defaults for branding, contact, WhatsApp deep-linking,
| and SEO scaffolding. Values are env-overridable so production can
| differ from local without touching code. Keep this file the single
| source of truth for "the business' identity at runtime".
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    */
    'brand' => [
        'name' => env('APP_NAME', 'Uprise'),
        'tagline' => 'Ghana\'s Premier Car Rental Service',
        'short_tagline' => 'Car & driver hire across Ghana and West Africa.',
        'legal_name' => env('UPRISE_LEGAL_NAME', 'Uprise Travel Ltd.'),
        // Parent brand — this site is the car-rental arm of Uprise Travel.
        'parent_name' => 'Uprise Travel',
        'parent_url' => env('UPRISE_PARENT_URL', 'https://uprisetravel.com'),
        'parent_blurb' => 'car rentals, tours & travel across Ghana and West Africa',
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    | Single source of truth for phone / email / address used across the
    | site footer, contact page, JSON-LD Organization, and inquiry mail.
    */
    'contact' => [
        'email' => env('UPRISE_CONTACT_EMAIL', 'cars@uprisetravel.com'),
        'phone' => env('UPRISE_CONTACT_PHONE', '+233 (0) 249 507 413'),
        'phone_e164' => env('UPRISE_CONTACT_PHONE_E164', '+233249507413'),
        'address' => [
            'street' => env('UPRISE_ADDRESS_STREET', 'Airport Residential Area'),
            'city' => env('UPRISE_ADDRESS_CITY', 'Accra'),
            'region' => env('UPRISE_ADDRESS_REGION', 'Greater Accra'),
            'country' => env('UPRISE_ADDRESS_COUNTRY', 'Ghana'),
            'country_code' => env('UPRISE_ADDRESS_COUNTRY_CODE', 'GH'),
        ],
        'hours' => env('UPRISE_HOURS', 'Mon–Fri, 9am–5pm GMT'),
        'hours_us' => env('UPRISE_HOURS_US', 'Mon–Fri, 1pm–7pm ET'),
        'phone_us' => env('UPRISE_PHONE_US', '+1 888 646 2266'),
    ],

    /*
    |--------------------------------------------------------------------------
    | WhatsApp
    |--------------------------------------------------------------------------
    | Number is in international format WITHOUT the leading "+" or spaces,
    | e.g. "233200000000". Used by WhatsAppLinkBuilder to compose wa.me URLs.
    */
    'whatsapp' => [
        'number' => env('UPRISE_WHATSAPP_NUMBER', '233249507413'),
        'default_message' => env(
            'UPRISE_WHATSAPP_DEFAULT_MESSAGE',
            'Hi Uprise Travel, I would like to inquire about car rental and driver services in Ghana.',
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Policy
    |--------------------------------------------------------------------------
    */
    'policy' => [
        'no_self_drive' => true,
        'driver_included_notice' => 'All vehicle rentals include a professional driver. We do not offer self-drive rentals.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Social
    |--------------------------------------------------------------------------
    */
    'social' => [
        'instagram' => env('UPRISE_SOCIAL_INSTAGRAM', 'https://www.instagram.com/uprisetravel/'),
        'facebook' => env('UPRISE_SOCIAL_FACEBOOK', 'https://www.facebook.com/uprisetravel/'),
        'linkedin' => env('UPRISE_SOCIAL_LINKEDIN'),
        'tiktok' => env('UPRISE_SOCIAL_TIKTOK'),
        'twitter' => env('UPRISE_SOCIAL_TWITTER'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO defaults
    |--------------------------------------------------------------------------
    | Used as fallbacks by SeoMetaResolver when a model has no SEO fields.
    */
    'seo' => [
        'default_og_image' => env('UPRISE_DEFAULT_OG_IMAGE'),
        'organization_logo' => env('UPRISE_ORGANIZATION_LOGO'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Inquiry
    |--------------------------------------------------------------------------
    */
    'inquiry' => [
        'notification_email' => env('UPRISE_INQUIRY_NOTIFICATION_EMAIL', env('UPRISE_CONTACT_EMAIL', 'cars@uprisetravel.com')),
        'rate_limit_per_minute' => env('UPRISE_INQUIRY_RATE_LIMIT', 5),
    ],

];
