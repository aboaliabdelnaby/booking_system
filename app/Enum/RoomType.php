<?php

namespace App\Enum;

enum RoomType:string
{
    use EnumToArrayTrait;
    case SINGLE  = 'single';
    case DOUBLE ='double';
    case SUITE = 'suite';

}
