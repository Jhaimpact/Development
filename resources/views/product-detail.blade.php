@extends('layout.master')
@section('title', 'Product-Detail')
@section('body')
    {{-- <x-generate-header :createbutton=0 /> --}}
    <div class="row">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-header text-capitalize pb-1 ">
                    <div class="form-group row justify-content-center">
                    <h6 class="col-sm-4 col-form-label">Please Choose Size Category Of {{$product->product_name}}</h6>
                        <select class="form-control parent-size-class col-sm-4" name="" id="">
                                <option value="" selected disabled>--Choose One--</option>
                                @foreach ($parent_size_attributes as $attribute_item)
                                    <option value="{{$attribute_item->id}}" >{{$attribute_item->size_name_on_front_end}}</option>
                                @endforeach
                        </select>
                        <div class="col-sm-4">
                            <button class="btn btn-info add-color-attribute">Add Color</button>
                            <a href="{{url()->current()}}" class="btn btn-danger">Reset</a>
                        </div>
                    </div>                    
                    
                </div>
                <div class="card-body attribute-box-container">
                    <form action="{{url('admin/product-attribute')}}" method="post">
                        @csrf
                        <div class="attribute-box border-bottom">
                            
                        </div>  
                    </form>
                    
                    {{-- <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $product)
                                    <tr>
                                        <td>{{ $product->product->product_name }}</td>
                                        <td>{{ $size_array[$product->size - 1] }}</td>
                                        <td>{{ $product->color_code }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <img class="table-image"
                                                src="{{ url('') . '/assets/productdetail/' . $product->detail_image }}"
                                                alt="Detail-Image" />
                                        </td>
                                        <td>
                                            <x-generate-button iname="{{ $product->product_name }}"
                                                id="{{ $product->id }}" />

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p>Product Details Are Not Available .</p>
                                            <a href="{{ '/product-detail/' . request()->segment(2) . '/edit' }}"
                                                class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Product Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
