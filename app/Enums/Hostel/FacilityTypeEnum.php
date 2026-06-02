<?php

namespace App\Enums\Hostel;

enum FacilityTypeEnum: string
{
    case WIFI = 'wifi';
    case LAUNDRY = 'laundry';
    case MESS = 'mess';
    case PARKING = 'parking';
    case CCTV = 'cctv';
    case GENERATOR = 'generator';
    case WATER_COOLER = 'water_cooler';
    case STUDY_ROOM = 'study_room';
    case GYM = 'gym';
}