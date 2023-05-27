<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'shop_category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shopCategory()
    {
        return $this->belongsTo(ShopCategory::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
