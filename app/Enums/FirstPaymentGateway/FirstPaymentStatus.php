<?php

namespace App\Enums\FirstPaymentGateway;

use App\Contracts\PaymentStatusContract;

enum FirstPaymentStatus: int implements PaymentStatusContract
{
    case NEW = 1;
    case PENDING = 2;
    case COMPLETED = 3;
    case EXPIRED = 4;
    case REJECTED = 5;
}
