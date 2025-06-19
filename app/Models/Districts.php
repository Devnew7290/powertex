<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'zip_code',
        'name_th',
        'name_en',
        'amphure_id',
    ];
}
