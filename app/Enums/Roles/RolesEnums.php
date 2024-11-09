<?php

namespace App\Enums\Roles;

enum RolesEnums: string
{
    case SUPERADMIN = 'SUPERADMIN';
    case DEVELOPER = 'DEVELOPER';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            self::SUPERADMIN => 'Administrateur',

            self::DEVELOPER => 'Developer',
        };
    }

    public static function options()
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $type) => [
                $type->value => $type->label(),
            ])
            ->toArray();
    }
}
