<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amphures extends Model
{
    protected $table = 'amphures';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'province_id',
    ];
}
