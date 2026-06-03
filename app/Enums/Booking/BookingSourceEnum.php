<?php

namespace App\Enums\Booking;

enum BookingSourceEnum:string
{
    case SELF = 'self';
    case OWNER = 'owner';
}