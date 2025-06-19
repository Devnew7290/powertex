<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsIndex extends Model
{
    protected $table = 'about_us_indices';
    protected $primaryKey = 'about_us_id';
    protected $fillable = [
        'about_us_topic',
        'about_us_detail',
        'about_us_image_front',
        'about_us_image_back',
        'about_us_powertex',
        'about_us_hugong',
        'about_us_sunflower',
        'about_us_keyword',
        'about_us_description',
        'about_us_dis',
        'FK_user_id',
        'FK_user_name',
    ];
}
