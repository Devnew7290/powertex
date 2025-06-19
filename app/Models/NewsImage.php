<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    protected $table = 'news_images';
    protected $primaryKey = 'news_image_id';
    protected $fillable = [
        'news_image_other',
        'FK_news_id',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
