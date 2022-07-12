<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewOrder extends Model
{
    protected $table = 'new_orders';
    protected $guarded = false;

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
