<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'news_image_cover',
        'news_image_banner',
        'news_topic',
        'news_detail',
        'news_date',
        'news_status',
        'news_type',
        'news_keywords',
        'news_description',
        'news_url',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
