<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    protected $table = 'why_us';
    protected $primaryKey = 'why_us_id';
    protected $fillable = [
        'why_us_vdo',
        'why_us_topic',
        'why_us_detail',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
