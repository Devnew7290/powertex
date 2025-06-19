<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name',
        'brand_logo',
        'brand_banner',
        'brand_number',
        'brand_keywords',
        'brand_description',
        'brand_url',
        'brand_status',
        'FK_user_id',
        'FK_user_name',
    ];
}
