@extends('layout.master')
@section('title', 'Manage-Product')
@section('body')
    @php
    $name = $result->product_name ?? (old('product_name') ?? '');
    $category_id = $result->category_id ?? (old('category_id') ?? '');
    $purchase_price = $result->purchase_price ?? (old('purchase_price') ?? '');
    $sell_price = $result->sell_price ?? (old('sell_price') ?? '');
    $feature_image = $result->feature_image ?? (old('feature_image') ?? '');
    $slider_image = $result->slider_image ?? (old('slider_image') ?? '');

    $product_description = $result->product_description ?? (old('product_description') ?? '');
    $return_policy_description = $result->return_policy_description ?? (old('return_policy_description') ?? '');
    $cod_policy_description = $result->cod_policy_description ?? (old('cod_policy_description') ?? '');
    
    $discount_type = $result->discount_type ?? (old('discount_type') ?? '');
    $discount = $result->discount ?? (old('discount') ?? '');
  
    $is_active = $result->is_active ?? (old('is_active') ?? '');
    $is_customizable = $result->is_customizable ?? (old('is_customizable') ?? '');
    $is_featured = $result->is_featured ?? (old('is_featured') ?? '');
    $is_flash_sale = $result->is_flash_sale ?? (old('is_flash_sale') ?? '');
    $can_return = $result->can_return ?? (old('can_return') ?? '');
  
  
  
  
    $feature_image = $result->feature_image ?? '';
    $slider_image = $result->slider_image ?? '';
    @endphp

    <x-generate-header :createbutton=0 />
    <div class="row justify-content-center">
        <div class="col-lg-11 mt-2">
            <div class="card">
                <div class="card-body">
                    <form class="user" method="POST" action="{{ url('').'/admin/product' }}" enctype="multipart/form-data">
                        @csrf
                        @if ($result != null)
                            @method('put')
                            <input type="hidden" name="id" value = "{{$result->id}}">
                        @endif
                        <div class="row">
                            <div class="col-md-3 com-sm-12 form-group">
                                <label for="">Product<span class="text-danger">*</span></label>
                                <input type="text" required class="form-control " id="exampleInputEmail" name="product_name"
                                    value="{{ $name }}" placeholder="Product name">
                            </div>
                            <div class="col-md-3 com-sm-12 form-group">
                                <label for="">Parent Category</label>
                                <select required name="parent_category_id" class="form-control product-parent-category">
                                    <option value="0" selected>--select parent category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 com-sm-12 form-group">
                                <label for="">Child Category<span class="text-danger">*</span></label>
                                <select required name="category_id" class="form-control category_id">
                                    <option value="0" selected>--select child category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 com-sm-12 form-group">
                                <label for="">Sell Price (INR )<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " required id="exampleInputEmail" name="sell_price"
                                    value="{{ $sell_price }}" placeholder="Sell Price">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="">Product Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" required id="exampleInputEmail" name="product_description"
                                    placeholder="Product Description">{{ $product_description }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="">Return Policy<span class="text-danger">*</span></label>
                              
                                <textarea class="form-control" required id="exampleInputEmail" name="return_policy_description"
                                    placeholder="Return Policy Description">{{ $return_policy_description }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="">COD Policy<span class="text-danger">*</span></label>
                                <textarea class="form-control " required id="exampleInputEmail" name="cod_policy_description"
                                    placeholder="COD Policy Description">{{ $cod_policy_description }}</textarea>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="">Discount</label>
                                <select name="discount_type" class="form-control" id="">
                                    <option value=''>--select discount type--</option>
                                    <option value="2" {{ $discount_type == '2' ? 'selected' : '' }}>Percentage</option>
                                    <option value="1" {{ $discount_type == '1' ? 'selected' : '' }}>Amount</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6  form-group">
                                <label for="">Discount Amount</label>
                                <input class="form-control " id="exampleInputEmail" name="discount" placeholder="Discount"
                                    value="{{ $discount }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label>Featured Image <span class="text-danger">{{!$result ? '*' :''}}</span></label>
                                <input type="file" {{!$result?'required':''}} accept="image/*" name="feature_image" class="form-control">
                                @if ($feature_image)
                                    <img class="table-image mt-2"
                                        src="{{ url('') . '/assets/feature_image/' . $feature_image }}" alt="feature image">
                                @endif
                            </div>
                            {{-- <div class="col-sm-12 col-md-6 form-group">
                                <label>Slider Images</label>
                                <input type="file" multiple accept="image/*" name="slider_image[]" class="form-control">
                                @if ($slider_image)
                                    <div class="mt-2">
                                        @foreach (json_decode($slider_image, true) as $item)
                                            <img class="table-image"
                                                src="{{ url('') . '/assets/productslider/' . $item }}" />
                                        @endforeach
                                    </div>
                                @endif
                            </div> --}}

                        </div>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-sm-12 d-flex justify-content-around">
                                        <div class="form-group">
                                            <input type="checkbox" {{ $is_active == '1' ? 'checked' : '' }} name="is_active"
                                             value="1" id="customCheck">
                                            <label  for="customCheck">Active</label>
                                        </div>
                                        <div class="form-group">
                                            <input  type="checkbox" {{ $is_featured == '1' ? 'checked' : '' }} name="is_featured"
                                            value="1" id="is_featured" />
                                            <label  for="is_featured">Is Featured</label>

                                        </div>             
                                        <div class="form-group">
                                            <label for="is_customizable">
                                                <input type="checkbox" {{ $is_customizable == '1' ? 'checked' : '' }} name="is_customizable"
                                                 value="1" id="is_customizable">
                                             Is Customizable</label>
                                        </div>

                                        <div class="form-group">
                                            <label  for="is_flash_sale">
                                                <input type="checkbox" {{ $is_flash_sale == '1' ? 'checked' : '' }} name="is_flash_sale"
                                                 value="1" id="is_flash_sale">
                                            Is Flash sale</label>
                                        </div>
                                        <div class="form-group">
                                            <label  for="can_return">
                                                <input type="checkbox" {{ $can_return == '1' ? 'checked' : '' }} name="can_return"
                                                 value="1" id="can_return">
                                            Can Return</label>
                                        </div>
                                    
                                    {{--
                                    
                                    --}}
                                {{-- </div> --}}
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                              
                                <a href="{{url('').'/admin/product'}}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
