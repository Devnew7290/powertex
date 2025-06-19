<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'products_id';
    protected $fillable = [
        'products_name',
        'products_code',
        'FK_brand',
        'FK_category_mains',
        'FK_category_sub',
        'FK_category_third',
        'products_price_full',
        'products_price_promotion',
        'products_note',
        'products_send',
        'products_quantity',
        'products_detail',
        'products_guarantee',
        'products_vdo',
        'products_manual',
        'products_manual_two',
        'products_index',
        'products_status',
        'products_keywords',
        'products_description',
        'products_url',
        'FK_user_id',
        'FK_user_name',
    ];

    public function imageFirst()
    {
        return $this->hasOne(ProductImage::class, 'FK_pi_product', 'products_id');
    }

    public function getImageUrlAttribute()
    {
        $img = $this->imageFirst;
        if ($img && $img->pi_image) {
            return asset($img->pi_image);
        }
        return asset('images/noimg.png');
    }

}