<?php

namespace App\Enums;

enum InquirySource: string
{
    case WebForm = 'web_form';
    case WhatsAppClick = 'whatsapp_click';
    case VehiclePage = 'vehicle_page';
    case ServicePage = 'service_page';
    case LandingPage = 'landing_page';

    public function label(): string
    {
        return match ($this) {
            self::WebForm => 'Web form',
            self::WhatsAppClick => 'WhatsApp click',
            self::VehiclePage => 'Vehicle page',
            self::ServicePage => 'Service page',
            self::LandingPage => 'Landing page',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $c) => [$c->value => $c->label()])
            ->all();
    }
}
