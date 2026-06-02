<?php

namespace App\Enums\Hostel;

enum NearbyPlaceTypeEnum: string
{
    case UNIVERSITY = 'university';
    case SCHOOL = 'school';
    case HOSPITAL = 'hospital';
    case MOSQUE = 'mosque';
    case BUS_STOP = 'bus_stop';
    case METRO = 'metro';
    case MARKET = 'market';
    case RESTAURANT = 'restaurant';
}