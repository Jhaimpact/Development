<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeAttributeValue extends Model
{
    use HasFactory;

    public function child(){
        return $this->hasMany(SizeAttributeValue::class,'id','size_parent_id');
        // ->withDefault();
    }

    public static function parent(){
        return Self::where("size_parent_id","=","0")->get();
    }
}
