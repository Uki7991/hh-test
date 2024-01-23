<?php

namespace App\DTO;

use App\Contracts\PaymentFormCallbackDTOContract;
use App\Contracts\PaymentStatusContract;
use Illuminate\Support\Str;

class SecondPaymentFormCallbackDTO implements PaymentFormCallbackDTOContract
{
    public readonly int $amount_paid;
    public readonly string $rand;
    public readonly string $status;
    public function __construct(
        public readonly int $project,
        public readonly int $invoice,
        PaymentStatusContract $status,
        public readonly int $amount,
    )
    {
        $this->amount_paid = $this->amount;
        $this->rand = Str::random();
        $this->status = Str::lower($status->name);
    }
}
