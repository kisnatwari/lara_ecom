<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'price',
        'brand_id',
        'quantity',
        'description',
        'images',
        'category_id',
        'seller_id'
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
