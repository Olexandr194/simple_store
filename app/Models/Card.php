<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $guarded = false;

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
