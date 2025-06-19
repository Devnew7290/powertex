<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    protected $table = 'product_promotions';
    protected $primaryKey = 'pp_id';
    protected $fillable = [
        'FK_pp_product',
        'FK_pp_promotion',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}