<?php

namespace App\PaymentGateways;

use App\Contracts\PaymentFormCallbackDTOContract;
use App\Contracts\PaymentGatewayContract;
use App\DTO\SecondPaymentFormCallbackDTO;
use App\Enums\SecondPaymentGateway\SecondPaymentStatus;
use App\Models\Payment;

class SecondPaymentGateway implements PaymentGatewayContract
{
    public readonly Payment $payment;
    private PaymentFormCallbackDTOContract $dto;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->dto = new SecondPaymentFormCallbackDTO($payment->merchant_id, $payment->id, SecondPaymentStatus::tryFrom($payment->status->value), $payment->amount);
    }

    public function jsonCallbackBody(): string
    {
        $data = get_object_vars($this->dto);
        ksort($data);

        return json_encode($data);
    }

    public function getHashedSign(): string
    {
        $data = get_object_vars($this->dto);
        ksort($data);

        $dataToString = implode('.', $data);
        $dataToString .= 'app_key';

        return md5($dataToString);
    }

    public function getHttpOptions(): array
    {
        return [
            'headers' => [
                'Authorization' => $this->getHashedSign(),
            ],
            'body' => $this->jsonCallbackBody(),
        ];
    }
}
