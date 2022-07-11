<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;
use App\Models\SizeAttributeValue;

use App\Http\Requests\StoreproductRequest;
// use App\Http\Requests\UpdateproductRequest;
use App\Http\Requests\CreateProductDetailRequest;
use App\Http\Requests\UpdateProductDetailRequest;


use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    
    public function index()
    {
        // if(!Gate::allows('view-auth')){
        //     abort(403);
        // }
        Gate::authorize('view-auth');
           
        $result = Product::all();
        return view('product',['result'=>$result]);
    }

    public function save_images($request){
        
        $feature_name = '';
        $slider_image_arr = null; 
        
        if($request->hasFile('feature_image')){
         $request->feature_image->move(public_path('assets/productimage'),$request->feature_image->getClientOriginalName());
            $feature_name = $request->feature_image->getClientOriginalName();
        }

        
        if($request->hasFile('slider_image')){
            foreach ($request->file('slider_image') as $key => $file) {
                $f_path = $file->move(public_path('assets/productslider'),$file->getClientOriginalName());   
                $f_name = $file->getClientOriginalName();   
                $slider_image_arr[$key] = $f_name;
            }
            $slider_image_arr = json_encode($slider_image_arr);
        }

        return ['feature_name'=>$feature_name , 'slider_image_arr'=>$slider_image_arr];

    }

    public function store(StoreproductRequest $request)
    {
        // if(!Gate::allows('create-auth')){
        //     abort(403);
        // }
        
        $operation_type = 0;
        $product_object = null;

        if($request->isMethod('post')){

                Gate::authorize('create-auth');
           
                $product_object = new Product();
                $operation_type = 1;

        }elseif($request->isMethod('put')){

                Gate::authorize('update-auth');
           
                $product_object = Product::find($request->id);
                $operation_type = 2;
        }



            $product_object->product_name = $request->product_name;
            $product_object->category_id = $request->category_id;
            $product_object->sell_price = $request->sell_price;
            $product_object->discount_type = $request->discount_type ?:0;
            $product_object->discount = $request->discount ?:0;
            $product_object->product_description = $request->product_description;
            $product_object->return_policy_description = $request->return_policy_description;
            $product_object->cod_policy_description = $request->cod_policy_description;
            $product_object->is_active = $request->input('is_active')?1:0;
            $product_object->is_featured = $request->input('is_featured')?1:0;
            $product_object->is_flash_sale = $request->input('is_flash_sale')?1:0;
            $product_object->is_customizable = $request->input('is_customizable')?1:0;
            $product_object->can_return = $request->input('can_return')?1:0;
            $product_object->system_user_id = Auth::user()->id;
       
   
        if($request->hasFile('feature_image')){
            $file= $request->file('feature_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/feature_image'), $filename);
            $product_object->feature_image = $filename;
        }


        // if($request->hasFile('category_image')){
        //     $file= $request->file('category_image');
        //     $filename= date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('assets/category_image'), $filename);
        //     $product_object->category_image = $filename;
        // }
    
        $result = $product_object->save();
    
        $this->setSessionData($result , $operation_type);

        if($result){
            return redirect('admin/product');
        }
    }

    public function show(Product $product =null) 
    {
        // if(!Gate::allows($product?'update-auth':'create-auth')){
        //     abort(403);
        // }
        Gate::authorize($product?'update-auth':'create-auth');
        return view('manage-product',['result' => $product , 'categories' => Category::all()]);
    }

    public function update(UpdateproductRequest $request, Product $product)
    {
        Gate::authorize('update-auth');
        // if(!Gate::allows('update-auth')){
        //     abort(403);
        // }
        
        $image_arr = $this->save_images($request);
        $update_arr = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'description' => $request->description,
            'product_status' => $request->input('product_status',0),  
        ];
        
        if($image_arr['feature_name']){
            $update_arr['feature_image'] = $image_arr['feature_name'];   
        }
        if($image_arr['slider_image_arr']){
            $update_arr['slider_image'] = $image_arr['slider_image_arr'];
        }

        if($product->update($update_arr))
        {            
            session()->flash('success',config('constants.UPDATE_SUCCESS'));
            return redirect('product');
        }else{
            session()->flash('error',config('constants.ERROR'));
        }
    }

    public function destroy(Product $product)
    {
        // if(!Gate::allows('delete-auth')){
        //     print_r(json_encode(['code'=>0]));die;
        // }
        
        Gate::authorize('delete-auth');
        print_r(json_encode(['code'=>$product->delete()]));
    }


    /*product detail management*/

    public function product_detail(Product $product){
        return view('product-detail',[ 'result'=>$product->product_detail , 'product'=>$product,'parent_size_attributes' => SizeAttributeValue::parent()]);
    }
    
    public function save_product_detail($product){
        
    }

    public function product_detail_show($product,ProductDetail $product_detail = null){
        return view('manage-product-detail',['result'=>$product_detail]);
    }
    
    public function product_detail_store(CreateProductDetailRequest $request){

        $batch_array = [];
        $key = 0;
        foreach ($request->data as  $value) {
            
            foreach ($value['meta'] as  $meta) {
                
                $batch_array[$key]['size'] = $value['size'];

                $batch_array[$key]['color_code'] = $meta['color_code'];

                $batch_array[$key]['quantity'] = $meta['quantity'];    

                $batch_array[$key]['product_id'] = request()->segment(2);
                
                $detail_image_name = $meta['detail_image']->getClientOriginalName();
                $meta['detail_image']->move(public_path('assets/productdetail'),$detail_image_name );
                $batch_array[$key]['detail_image'] = $detail_image_name;
            
                $key++;
            }
        }

     
        // if(ProductDetail::insert($batch_array)){
        if(ProductDetail::upsert($batch_array,['product_id','color_code','size'],['quantity'])){
            session()->flash('success',config('constants.INSERT_SUCCESS'));
            return redirect('product-detail/'.request()->segment(2));
        }else{
            session()->flash('error',config('constants.error'));
        }
        
    }
    
    public function product_detail_update(UpdateProductDetailRequest $request,$product,ProductDetail $product_detail){
        
        // return $request;

        $update_array = [
            'size' => $request->data[0]['size'] ,
            'color_code' =>$request->data[0]['meta'][0]['color_code'], 
            'quantity' => $request->data[0]['meta'][0]['quantity']
        ];

        
        if(isset($request->data[0]['meta'][0]['detail_image'])){
            $detail_image_name = $request->data[0]['meta'][0]['detail_image']->getClientOriginalName();
            $request->data[0]['meta'][0]['detail_image']->move(public_path('assets/productdetail'),$detail_image_name );
            $update_array['detail_image'] = $detail_image_name;
        }
        
        // if(ProductDetail::upsert(){
        try{
            if($product_detail->update($update_array)){
                session()->flash('success',config('constants.UPDATE_SUCCESS'));
                return redirect('product-detail/'.$request->segment(2));
            }else{
                session()->flash('error',config('constants.ERROR'));
            }
        }catch(QueryException $e){
            session()->flash('error','You already have the product with same size and color, try updating that');
            return redirect('product-detail/'.$request->segment(2));
        }
    }
    
    public function product_detail_destroy($product ,ProductDetail $product_detail){
        return json_encode(['code'=>$product_detail->delete()]);
    }
}