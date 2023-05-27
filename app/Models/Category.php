<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["seller_id", "name"];
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
