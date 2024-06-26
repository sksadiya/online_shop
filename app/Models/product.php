<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function product_images() {
        return $this->hasMany(productImage::class);
    }
    public function product_ratings() {
        return $this->hasMany(ProductRating::class)->where('status',1);
    }
   
}
