<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'member';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'birthday',
        'phone',
        'address',
        'province',
        'district',
        'sub_district',
        'postcode',
        'provider',
        'provider_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    public function memberAddresses()
    {
        return $this->hasMany(MemberAddress::class, 'member_id');
    }
}
