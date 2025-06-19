<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    protected $table = 'banners';
    protected $primaryKey = 'banner_id';
    protected $fillable = [
        'banner_number',
        'banner_image',
        'banner_show',
        'FK_user_id',
        'FK_user_name',
    ];
}
