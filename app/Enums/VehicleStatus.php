<?php

namespace App\Enums;

enum VehicleStatus: string
{
    case Available = 'available';
    case Unavailable = 'unavailable';
    case ComingSoon = 'coming_soon';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Unavailable => 'Unavailable',
            self::ComingSoon => 'Coming soon',
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
