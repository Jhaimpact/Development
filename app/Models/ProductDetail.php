<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'color_code',
        'quantity',
        'detail_image'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}