<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');  // Each product has many orders
    }
}
