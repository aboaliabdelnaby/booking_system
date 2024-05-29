<?php

namespace App\Enum;

enum RequestStatus:string
{
    use EnumToArrayTrait;
    case PENDING  = 'pending';
    case APPROVED ='approved';
    case REJECTED = 'rejected';
}
