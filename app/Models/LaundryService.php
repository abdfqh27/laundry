<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'unit', 'is_active'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'service_id');
    }
}