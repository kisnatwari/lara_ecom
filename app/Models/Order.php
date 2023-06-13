<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "product_id",
        "quantity",
        "status",
        "created_at",
        "updated_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->hasOneThrough(Seller::class, Product::class, 'id', 'id', 'product_id', 'seller_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
