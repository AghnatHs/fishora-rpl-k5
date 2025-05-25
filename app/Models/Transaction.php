<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'order_id',
        // Add other fillable fields as needed
    ];
    
    /**
     * Get the order associated with the transaction.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Get the customer who made this transaction.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}