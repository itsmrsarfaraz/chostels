<?php

namespace App\Enums\Bed;

enum BedStatusEnum:string
{
    case AVAILABLE = 'available';
    case OCCUPIED = 'occupied';
    case RESERVED = 'reserved';
    case MAINTENANCE = 'maintenance';
}