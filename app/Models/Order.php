<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PHPUnit\TextUI\Configuration\Constant;

class Order extends Model
{
    use HasUlids;

    protected $fillable = [
        'customer_id',
        'status_payment',
        'status_delivery'
    ];

    public function isCart(): bool
    {
        return $this->status_payment == Constants\Orders::STATUS_PAYMENT_CART
            || $this->status_delivery == Constants\Orders::STATUS_DELIVERY_CART;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
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
