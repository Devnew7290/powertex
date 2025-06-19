<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealers extends Model
{
    protected $table = 'dealers';
    protected $primaryKey = 'dealer_id';
    protected $fillable = [
        'dealer_name',
        'dealer_image',
        'dealer_address',
        'FK_province_id',
        'FK_amphures_id',
        'FK_districts_id',
        'dealer_address_code',
        'dealer_day_open',
        'dealer_time_open',
        'dealer_time_close',
        'dealer_phone',
        'dealer_map',
        'dealer_line',
        'dealer_facebook',
        'dealer_show',
        'FK_user_id',
        'FK_user_name',
    ];
}
