<?php

namespace App\Models;

use App\Contracts\PaymentStatusContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'status',
        'amount',
    ];
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
