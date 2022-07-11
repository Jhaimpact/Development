<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    private $user_id; 

    public function __construct(){
        parent::__construct();
        $this->user_id = auth('sanctum')->user()->id;
    }

    public function getWishlist(){
        $result = Wishlist::where("user_id","=",$this->user_id)->get();
        return response()->json([
            'status' => 1,
            'result'  => $result
        ]);
    }

    public function saveWishlist($product){
        $response = Wishlist::updateOrCreate(
            ['user_id' => $this->user_id, 'product_id' => $product , 'subproduct_id' => $product],
            ['user_id' => $this->user_id, 'product_id' => $product , 'subproduct_id' => $product]
        );
        return $this->sendOperationResponse($response,7);
    }

    public function deleteWishlist($product){
       
        $result = Wishlist::where("user_id","=",$this->user_id)
                    ->where("product_id","=",$product)
                    ->first();
        if(!$result){
            return response()->json(['status' => 0 , 'message' => 'Opps! Row Could not found']);
        }

        $response = $result->delete();
         
        return $this->sendOperationResponse($response,8);
    }
}
