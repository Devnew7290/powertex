<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'pi_id';
    protected $fillable = [
        'pi_image',
        'FK_pi_product',
        'FK_user_id',
        'FK_user_name',
    ];
}