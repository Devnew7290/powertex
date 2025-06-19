<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promocode extends Model
{
    protected $table = 'promocodes';
    protected $primaryKey = 'promocode_id';
    protected $fillable = [
        'promocode_image',
        'promocode_code',
        'promocode_date_start',
        'promocode_date_end',
        'promocode_min_price',
        'promocode_price',
        'promocode_price_type',
        'promocode_type',
        'promocode_product',
        'promocode_number',
        'promocode_user',
        'promocode_user_use',
        'promocode_status',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
