<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAddress extends Model
{
    protected $fillable = [
        'member_id', 'type', 'firstname', 'lastname', 'address',
        'province', 'district', 'sub_district', 'postcode', 'phone',
        'company_name', 'tax_number'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
