<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalogs';
    protected $primaryKey = 'catalog_id';
    protected $fillable = [
        'catalog_pdf',
        'FK_user_id',
        'FK_user_name',
    ];
}
