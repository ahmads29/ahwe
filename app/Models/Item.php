<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'price'];

    // Relationship: An item belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
