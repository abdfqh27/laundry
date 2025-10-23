<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'order_number', 'notes', 'status', 
        'payment_status', 'total_amount', 'pickup_date', 
        'delivery_date', 'karyawan_id'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }
}