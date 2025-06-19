<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextHaeder extends Model
{
    protected $table = 'text_haeders';
    protected $primaryKey = 'texth_id';
    protected $fillable = [
        'texth_text',
        'texth_link',
        'texth_status',
        'FK_user_id',
        'FK_user_name',
    ];
}
