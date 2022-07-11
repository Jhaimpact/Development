<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;


use App\Models\Category;

class CategoryController extends Controller
{
    public function construct(){

    }

    public function featureCategory(){

        $result = Category::where("is_featured","=","1")
                    ->where("is_active",'=',"1")
                    ->get();

        return response()->json([
            'status' => 1,
            'result'  => $result
        ]);
    }

    public function getCategory(){

        $result = Category::where("parent_id","=",0)->paginate(6);
        return response()->json([
            'status' => 1,
            'result'  => $result
        ]);
        
    }


    public function index()
    {
        // if(!Gate::allows('view-auth')){
        //     abort(403);
        // }
        Gate::authorize('view-auth');
                

        $result = Category::all();
        return view('category',['result'=> $result]);
    }

    
    public function store(StorecategoryRequest $request)
    {
        // if(!Gate::allows('create-auth')){
        //     abort(403);
        // }
        
        
        $operation_type = 0;
        $category_object = null;
        
        if($request->isMethod('post')){
        
                Gate::authorize('create-auth');
                $category_object = new Category();
                $operation_type = 1;
        
        }elseif($request->isMethod('put')){

                Gate::authorize('update-auth');

                $category_object = Category::find($request->id);
                $operation_type = 2;
        }



       
        $category_object->parent_id = $request->parent;
        $category_object->category_status = $request->status?1:0;
        $category_object->is_featured  =  $request->is_featured ? 1 : 0;
        $category_object->category_name = $request->name;
       
   
        if($request->hasFile('category_icon')){
            $file= $request->file('category_icon');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/category_icon'), $filename);
            $category_object->category_icon = $filename;
        }


        if($request->hasFile('category_image')){
            $file= $request->file('category_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/category_image'), $filename);
            $category_object->category_image = $filename;
        }
    
        $result = $category_object->save();
    
        $this->setSessionData($result , $operation_type);

        if($result){
            return redirect('admin/category');
        }
    }

    public function show(Category $category = null)
    {

        Gate::authorize($category?'update-auth':'create-auth');
       
        
        return view('manage-category',['result'=>$category , 'categories'=>Category::where("parent_id","=","0")->get()]);
    }

    public function edit(category $category)
    {

    }
 
    public function update(UpdatecategoryRequest $request, Category $category)
    {
        Gate::authorize('create-auth');
        // if(!Gate::allows('update-auth')){
        //     abort(403);
        // }
        
        if($category->update([
            'parent_id'=>$request->parent,
            'category_status'=>$request->status?$request->status:0,
            'category_name'=>$request->name
        ])){
            $request->session()->flash('success',config('constants.UPDATE_SUCCESS'));
            return redirect('category');
        }else{
            $request->session()->flash('error',config('constants.ERROR'));
        }
    }

   
    public function destroy(Category $category)
    {
        // if(!Gate::allows('delete-auth')){
        //    print_r(json_encode(['code'=>0]));die;
        // }

        Gate::authorize('delete-auth');
           
        print_r(json_encode(['code'=>$category->delete()]));
    }
}
