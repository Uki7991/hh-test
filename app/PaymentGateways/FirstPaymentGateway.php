<?php

namespace App\PaymentGateways;

use App\Contracts\PaymentFormCallbackDTOContract;
use App\Contracts\PaymentGatewayContract;
use App\DTO\FirstPaymentFormCallbackDTO;
use App\Enums\FirstPaymentGateway\FirstPaymentStatus;
use App\Models\Payment;

class FirstPaymentGateway implements PaymentGatewayContract
{
    public readonly Payment $payment;
    private PaymentFormCallbackDTOContract $dto;
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->dto = new FirstPaymentFormCallbackDTO($payment->merchant_id, $payment->id, FirstPaymentStatus::tryFrom($payment->status->value), $payment->amount);
    }

    public function jsonCallbackBody(): string
    {
        $data = get_object_vars($this->dto);
        ksort($data);
        $sign = $this->getHashedSign();

        return json_encode(array_merge($data, ['sign' => $sign]));
    }

    public function getHashedSign(): string
    {
        $data = get_object_vars($this->dto);
        ksort($data);

        $dataToString = implode(':', $data);
        $dataToString .= 'merchant_key';

        return \hash('sha256', $dataToString);
    }

    public function getHttpOptions(): array
    {
        return [
            'body' => $this->jsonCallbackBody(),
        ];
    }
}
