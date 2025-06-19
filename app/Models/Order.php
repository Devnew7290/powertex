<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_number', 'member_id', 'order_date', 'total_amount',
        'payment_status', 'shipping_status', 'shipping_address_id', 'invoice_address_id', 'transaction_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(MemberAddress::class, 'shipping_address_id');
    }

    public function invoiceAddress()
    {
        return $this->belongsTo(MemberAddress::class, 'invoice_address_id');
    }
}
