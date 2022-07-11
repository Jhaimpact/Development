<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_status',
        'parent_id',
        'category_icon',
        'category_image'
    ];

    function childCategory(){
        return $this->hasMany(Category::class,'id','parent_id')->withDefault();
    }

    function parentCategory(){
        return $this->belongsTo(Category::class,'parent_id','id')->withDefault();
    }

    function product(){
        return $this->hasMany(Product::class)->withDefault();
    }

    protected function categoryIcon(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => parse_url(asset('assets/category_icon/'.$value)),
        );
    }
    
    protected function categoryImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/category_image/'.$value),
        );
    }
}
