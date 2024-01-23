<?php

namespace App\Http\Controllers\v1;

use App\Enums\GeneralPaymentStatus;
use App\Events\PaymentUpdatedStatusEvent;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function complete(Request $request, Payment $payment)
    {
        $payment->update([
            'status' => GeneralPaymentStatus::COMPLETED
        ]);

        Log::info("Payment successfully completed: \t".
            "payment_id: $payment->id \t".
            "merchant_id: $payment->merchant_id");

        $gatewayClass = config('payments.'.$payment->merchant->merchant_type->value.'.gateway');

        event(new PaymentUpdatedStatusEvent(new $gatewayClass($payment)));

        return response()->json(['status' => 'success']);
    }

    public function reject(Request $request, Payment $payment)
    {
        $payment->update([
            'status' => GeneralPaymentStatus::REJECTED
        ]);

        Log::info("Payment rejected: \t".
            "payment_id: $payment->id \t".
            "merchant_id: $payment->merchant_id");

        $gatewayClass = config('payments.'.$payment->merchant->merchant_type->value.'.gateway');

        event(new PaymentUpdatedStatusEvent(new $gatewayClass($payment)));

        return response()->json(['status' => 'success']);
    }
}
