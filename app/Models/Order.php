<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the relationship with the User model
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');  // Corrected to belongsTo
    }
}
