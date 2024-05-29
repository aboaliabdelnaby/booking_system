<?php

namespace App\Enum;

enum RoomStatus:string
{
    use EnumToArrayTrait;
    case AVAILABLE  = 'available';
    case BOOKED ='booked';
    case PENDING = 'pending';
}
