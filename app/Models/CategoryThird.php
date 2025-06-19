<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryThird extends Model
{
    protected $table = 'category_thirds';
    protected $primaryKey = 'ct_id';
    protected $fillable = [
        'ct_name',
        'ct_number',
        'FK_category_main',
        'FK_category_sub',
        'ct_status',
        'FK_user_id',
        'FK_user_name',
    ];
}
