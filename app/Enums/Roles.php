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
        switch ($role) {
            case 'platinum':
                return Roles::PLATINUM;
            case 'staff':
                return Roles::STAFF;
            case 'mentor':
                return Roles::MENTOR;
            default:
                return null;
        }
    }
}
