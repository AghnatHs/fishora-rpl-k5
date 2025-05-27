<?php

namespace App\Models;

use App\Constants\Orders;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasUlids;

    protected $fillable = [
        'customer_id',
        'status_payment',
        'status_delivery'
    ];

    protected $attributes = [
        'status_payment' => Orders::STATUS_PAYMENT_CART,
        'status_delivery' => Orders::STATUS_DELIVERY_CART
    ];

    protected $with = [
        'orderLines'
    ];

    public function isCart(): bool
    {
        return $this->status_payment === Orders::STATUS_PAYMENT_CART
            || $this->status_delivery === Orders::STATUS_DELIVERY_CART;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeCartStatus(Builder $query): Builder
    {
        return $query
            ->where('status_delivery', Orders::STATUS_DELIVERY_CART)
            ->where('status_payment', Orders::STATUS_PAYMENT_CART);
    }

    public function scopeCartProductCountForUser(Builder $query, $userId): int
    {
        return $query
            ->where('customer_id', $userId)
            ->cartStatus()
            ->join('order_lines', 'orders.id', '=', 'order_lines.order_id')
            ->distinct('order_lines.product_id')
            ->count('order_lines.product_id');
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
