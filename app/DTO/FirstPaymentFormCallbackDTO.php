<?php

namespace App\DTO;

use App\Contracts\PaymentFormCallbackDTOContract;
use App\Contracts\PaymentStatusContract;
use Illuminate\Support\Str;

class FirstPaymentFormCallbackDTO implements PaymentFormCallbackDTOContract
{
    public readonly \DateTime $timestamp;
    public readonly int $amount_paid;
    public readonly string $status;
    public function __construct(
        public readonly int $merchant_id,
        public readonly int $payment_id,
        PaymentStatusContract $status,
        public readonly int $amount,
    )
    {
        $this->timestamp = now();
        $this->amount_paid = $this->amount;
        $this->status = Str::lower($status->name);
    }
}
