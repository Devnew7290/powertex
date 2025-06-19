<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandsImage extends Model
{
    protected $table = 'brands_images';
    protected $primaryKey = 'bi_id';
    protected $fillable = [
        'bi_image',
        'FK_bi_id',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
