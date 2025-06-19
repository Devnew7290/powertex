<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySub extends Model
{
    protected $table = 'category_subs';
    protected $primaryKey = 'cs_id';
    protected $fillable = [
        'cs_name',
        'cs_number',
        'FK_category_main',
        'cs_status',
        'FK_user_id',
        'FK_user_name',
    ];
}
