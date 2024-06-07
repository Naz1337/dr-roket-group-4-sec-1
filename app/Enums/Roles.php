<?php

namespace App\Enums;

class Roles
{
    const PLATINUM = 0;

    // CRMP = 1
    // Role Crmp don't exist.
    const STAFF = 2;
    const MENTOR = 3;

    static function getEnumValue($role) {
        return match ($role) {
            'platinum' => Roles::PLATINUM,
            'staff' => Roles::STAFF,
            'mentor' => Roles::MENTOR,
            default => null,
        };
    }

    static function getEnumKey($value) {
        return match ($value) {
            Roles::PLATINUM => 'platinum',
            Roles::STAFF => 'staff',
            Roles::MENTOR => 'mentor',
            default => null,
        };
    }

}
