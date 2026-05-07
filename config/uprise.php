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
        'tagline' => 'Premium Chauffeur & Transportation Services in Ghana',
        'short_tagline' => 'Chauffeur-driven transportation, redefined.',
        'legal_name' => env('UPRISE_LEGAL_NAME', 'Uprise Transport Ltd.'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    | Single source of truth for phone / email / address used across the
    | site footer, contact page, JSON-LD Organization, and inquiry mail.
    */
    'contact' => [
        'email' => env('UPRISE_CONTACT_EMAIL', 'hello@uprise.com.gh'),
        'phone' => env('UPRISE_CONTACT_PHONE', '+233 20 000 0000'),
        'phone_e164' => env('UPRISE_CONTACT_PHONE_E164', '+233200000000'),
        'address' => [
            'street' => env('UPRISE_ADDRESS_STREET', 'Airport Residential Area'),
            'city' => env('UPRISE_ADDRESS_CITY', 'Accra'),
            'region' => env('UPRISE_ADDRESS_REGION', 'Greater Accra'),
            'country' => env('UPRISE_ADDRESS_COUNTRY', 'Ghana'),
            'country_code' => env('UPRISE_ADDRESS_COUNTRY_CODE', 'GH'),
        ],
        'hours' => env('UPRISE_HOURS', 'Mon–Sun, 24/7'),
    ],

    /*
    |--------------------------------------------------------------------------
    | WhatsApp
    |--------------------------------------------------------------------------
    | Number is in international format WITHOUT the leading "+" or spaces,
    | e.g. "233200000000". Used by WhatsAppLinkBuilder to compose wa.me URLs.
    */
    'whatsapp' => [
        'number' => env('UPRISE_WHATSAPP_NUMBER', '233200000000'),
        'default_message' => env(
            'UPRISE_WHATSAPP_DEFAULT_MESSAGE',
            'Hi Uprise, I would like to make a transportation inquiry.',
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Social
    |--------------------------------------------------------------------------
    */
    'social' => [
        'instagram' => env('UPRISE_SOCIAL_INSTAGRAM'),
        'facebook' => env('UPRISE_SOCIAL_FACEBOOK'),
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
        'notification_email' => env('UPRISE_INQUIRY_NOTIFICATION_EMAIL', env('UPRISE_CONTACT_EMAIL', 'hello@uprise.com.gh')),
        'rate_limit_per_minute' => env('UPRISE_INQUIRY_RATE_LIMIT', 5),
    ],

];
