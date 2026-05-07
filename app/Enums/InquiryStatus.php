<?php

namespace App\Enums;

enum InquiryStatus: string
{
    case New_ = 'new';
    case Contacted = 'contacted';
    case Qualified = 'qualified';
    case Won = 'won';
    case Lost = 'lost';

    public function label(): string
    {
        return match ($this) {
            self::New_ => 'New',
            self::Contacted => 'Contacted',
            self::Qualified => 'Qualified',
            self::Won => 'Won',
            self::Lost => 'Lost',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::New_ => 'info',
            self::Contacted => 'warning',
            self::Qualified => 'primary',
            self::Won => 'success',
            self::Lost => 'danger',
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
