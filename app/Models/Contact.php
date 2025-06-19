<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'contacts_id';
    protected $fillable = [
        'contacts_map',
        'contacts_address',
        'contacts_phone',
        'contacts_fax',
        'contacts_email',
        'contacts_facebook',
        'contacts_line',
        'contacts_ig',
        'contacts_yt',
        'contacts_tiktok',
        'contacts_twitter',
        'contacts_keyword',
        'contacts_description',
        'contacts_url',
        'FK_user_id',
        'FK_user_name',
    ];
}
