<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPromocode extends Model
{
    protected $table = 'product_promocodes';
    protected $primaryKey = 'ppc_id';
    protected $fillable = [
        'FK_ppc_product',
        'FK_ppc_promocode',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
