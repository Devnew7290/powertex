<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'geography_id',
    ];
}
