<?php

namespace App\Enums;

enum RolesEnum: string
{

    case ADMIN = 'Admin';
    case ELDER = 'Anciano';
    case P_GENERAL = 'Pastor General';
    case P_DISTRICT = 'Pastor de Distrito';
    case P_ZONE = 'Pastor de Zona';
    case SUPERVISOR = 'Supervisor';
    case LEADER = 'Lider';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::ELDER => 'Anciano',
            static::P_GENERAL => 'Pastor General',
            static::P_DISTRICT => 'Pastor de Distrito',
            static::P_ZONE => 'Pastor de Zona',
            static::SUPERVISOR => 'Supervisor',
            static::LEADER => 'Lider',
        };
    }
}
