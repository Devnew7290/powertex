<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'service_id';
    protected $fillable = [
        'service_name',
        'service_repair',
        'service_address',
        'service_note',
        'service_success',
        'service_show',
    ];
}
