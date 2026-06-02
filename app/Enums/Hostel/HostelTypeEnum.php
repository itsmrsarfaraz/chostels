<?php

namespace App\Enums\Hostel;

enum HostelTypeEnum:string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
}