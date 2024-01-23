<?php

namespace App\Contracts;

use App\Models\Payment;

interface PaymentGatewayContract
{
    public function __construct(Payment $payment);

    public function jsonCallbackBody(): string;

    public function getHashedSign(): string;

    public function getHttpOptions(): array;
}
