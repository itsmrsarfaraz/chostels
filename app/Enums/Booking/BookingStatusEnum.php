<?php

namespace App\Enums\Booking;

enum BookingStatusEnum:string
{
    case PENDING = 'pending';
    case AWAITING_ACCEPTANCE = 'awaiting_acceptance';
    case CONFIRMED = 'confirmed';
    case CHECKED_IN = 'checked_in';
    case CHECKED_OUT = 'checked_out';
    case CANCELLED = 'cancelled';
    case REJECTED = 'rejected';
}