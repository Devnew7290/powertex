<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_logs';

    protected $fillable = [
        'order_no',
        'payment_status',
        'payment_status_code',
        'payment_step',
        'psp_reference_no',
        'psp_invoice_no',
        'approval_code',
        'amount',
        'currency_code',
        'payment_type',
        'channel_code',
        'card_number_last4',
        'payer_name',
        'card_holder_name',
        'response_code',
        'response_desc',
        'response_raw',
        'paid_at',
    ];

    protected $casts = [
        'response_raw' => 'array',
        'paid_at' => 'datetime',
    ];
}
