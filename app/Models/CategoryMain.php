<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMain extends Model
{
    protected $table = 'category_mains';
    protected $primaryKey = 'cm_id';
    protected $fillable = [
        'cm_name',
        'cm_number',
        'cm_status',
        'FK_user_id',
        'FK_user_name',
    ];
}
