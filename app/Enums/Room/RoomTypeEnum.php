<?php

namespace App\Enums\Room;

enum RoomTypeEnum:string
{
    case PRIVATE = 'private';
    case SHARED = 'shared';
}