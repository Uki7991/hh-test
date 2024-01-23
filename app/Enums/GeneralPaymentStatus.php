<?php

namespace App\Enums;

enum GeneralPaymentStatus: int
{
    case CREATED = 1;
    case PENDING = 2;
    case COMPLETED = 3;
    case EXPIRED = 4;
    case REJECTED = 5;
}
