<?php

namespace App\Enums;

enum StepEnum: string
{
    case CONVERSION = 'Conversión';
    case RECONCILIO = 'Reconcilio';
    case WATER_BAPTIZED = 'Bautizado en agua';
    case HOLY_SPIRIT_BAPTIZED = 'Bautizado en Espíritu Santo';
    case LEADER_ROUTE = 'Rute del Líder';
}
