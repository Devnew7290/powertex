<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'promotion_id';
    protected $fillable = [
        'promotion_image_cover',
        'promotion_topic',
        'promotion_detail',
        'promotion_date_start',
        'promotion_date_end',
        'promotion_price',
        'promotion_type',
        'promotion_number',
        'promotion_product',
        'promotion_status',
        'promotion_keyword',
        'promotion_description',
        'promotion_url',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}