<?php

return [
    'first' => [
        'gateway' => \App\PaymentGateways\FirstPaymentGateway::class,
        'status' => \App\Enums\FirstPaymentGateway\FirstPaymentStatus::class,
    ],
    'second' => [
        'gateway' => \App\PaymentGateways\SecondPaymentGateway::class,
        'status' => \App\Enums\SecondPaymentGateway\SecondPaymentStatus::class,
    ],
];
