<?php

namespace App\Enums\SecondPaymentGateway;

use App\Contracts\PaymentStatusContract;

enum SecondPaymentStatus: int implements PaymentStatusContract
{
    case CREATED = 1;
    case IN_PROGRESS = 2;
    case PAID = 3;
    case EXPIRED = 4;
    case REJECTED = 5;
}
