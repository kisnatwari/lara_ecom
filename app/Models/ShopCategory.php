<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;
    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }


    public function products(){
        return $this->hasManyThrough(Product::class, Seller::class);
    }
}
