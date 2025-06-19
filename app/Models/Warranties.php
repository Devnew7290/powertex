<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warranties extends Model
{
    protected $table = 'warranties';
    protected $primaryKey = 'warranty_id';
    protected $fillable = [
        'warranty_name',
        'warranty_product',
        'warranty_serial_number',
        'warranty_number',
        'warranty_success',
        'warranty_show',
    ];
}
