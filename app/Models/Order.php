<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    // Relationship: An order has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}