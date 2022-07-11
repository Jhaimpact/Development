<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'category_id',
        'purchase_price',
        'sell_price',
        'feature_image',
        'slider_image',
        'description',
        'discount_type',
        'discount',
        'product_status'
    ];

    function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    function product_detail(){
        return $this->hasMany(ProductDetail::class);
    }
}