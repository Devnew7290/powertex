<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    protected $table = 'guarantees';
    protected $primaryKey = 'guarantees_id';
    protected $fillable = [
        'guarantees_icon',
        'guarantees_topic',
        'guarantees_detail',
        'guarantees_number',
        'FK_user_id',
        'FK_user_name',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timedtamp = false;
}
