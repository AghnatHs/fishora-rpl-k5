<?php

namespace App\Constants;

class Orders
{
    public const STATUS_PAYMENT_CART = 'CART';
    public const STATUS_PAYMENT_PENDING   = 'PENDING';
    public const STATUS_PAYMENT_PAID      = 'PAID';
    public const STATUS_PAYMENT_FAILED    = 'FAILED';
    public const STATUS_PAYMENT_EXPIRED   = 'EXPIRED';
    public const STATUS_PAYMENT_REFUNDED  = 'REFUNDED';

    public const STATUS_DELIVERY_CART = 'CART';
    public const STATUS_DELIVERY_PENDING   = 'PENDING';
    public const STATUS_DELIVERY_PACKED    = 'PACKED';
    public const STATUS_DELIVERY_SHIPPED   = 'SHIPPED';
    public const STATUS_DELIVERY_DELIVERED = 'DELIVERED';
    public const STATUS_DELIVERY_CANCELLED = 'CANCELLED';
    public const STATUS_DELIVERY_RETURNED  = 'RETURNED';
}
