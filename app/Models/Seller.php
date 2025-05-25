<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Product;
use App\Notifications\SellerResetPasswordNotification;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $shop_name
 * @property string $telephone
 * @property string $address_street
 * @property string $address_city
 * @property string $address_province
 * @property int $address_zipcode
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $admin_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $ktp
 * @property string|null $ktp_mime
 * @property string|null $proof_of_business
 * @property string|null $proof_of_business_mime
 * @property string|null $admin_verified_accepted
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereAddressCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereAddressProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereAddressStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereAddressZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereAdminVerifiedAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereAdminVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereKtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereKtpMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereProofOfBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereProofOfBusinessMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seller whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SellerResetPasswordNotification($token));
    }

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
