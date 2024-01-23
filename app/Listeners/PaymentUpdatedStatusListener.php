<?php

namespace App\Listeners;

use App\Events\PaymentUpdatedStatusEvent;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class PaymentUpdatedStatusListener
{
    private Client $httpClient;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentUpdatedStatusEvent $event): void
    {
        /**
         * @var Payment $payment
         */
        $payment = $event->gateway->payment;

//        $this->httpClient->post($payment->merchant->callback_url, $event->gateway->getHttpOptions());

        Log::debug(json_encode([$payment->merchant->callback_url, $event->gateway->getHttpOptions()]));
    }
}
