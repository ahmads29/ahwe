<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'total_price'];

    // Relationship: A receipt belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
