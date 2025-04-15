<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use HasUlids, Notifiable;

    protected $fillable = [
        'shop_name',
        'telephone',
        'email',
        'password',
        'address_street',
        'address_city',
        'address_province',
        'address_zipcode',
        'admin_verified_at',
        'admin_verified_status',
        'ktp',
        'ktp_mime',
        'proof_of_business',
        'proof_of_business_mime'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Str::ulid()->toBase32();
            }
        });
    }
}
