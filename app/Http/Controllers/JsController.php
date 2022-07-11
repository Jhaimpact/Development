<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;
use App\Models\SizeAttributeValue;

use Illuminate\Http\Request;

class JsController extends Controller
{
    
    public function __construct(){
        parent::__construct();
    }

    public function get_chlid_category($parent){

        $result = Category::where("parent_id","=",$parent)->get();
      
        return $this->sendOperationResponse(true , 1 , $result );
    }

    function get_child_size(SizeAttributeValue $parent){
        return($parent->child());
        // echo "'sdlfjlsdfj'<br/>";
        // print_r($parent->child());
        // return $this->sendOperationResponse(true , 1 , $parent->child() );
    }
}
