<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceWarranty extends Model
{
    protected $table = 'service_warranties';
    protected $primaryKey = 'swd_id';
    protected $fillable = [
        'swd_image',
        'swd_type',
        'swd_FK_id',
    ];
}
