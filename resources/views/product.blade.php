@extends('layout.master')
@section('title', 'Product')
@section('body')
    <x-generate-header />
    <div class="row">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Sell Price</th>
                                    <th>Discount Amount</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->product_description }}</td>
                                        <td>{{ $product->sell_price }}</td>
                                        <td>{{ $product->discount_type ? ($product->discount.($product->discount_type == '2' ?'%' :'') ) : 0 }}
                                        </td>
                                        <td>

                                            <img class="table-image"
                                                src="{{ url('') . '/assets/feature_image/' . $product->feature_image }}" />
                                        </td>
                                        <td>
                                            <x-generate-button iname="{{ $product->product_name }}"
                                                id="{{ $product->id }}" />
                                            <a href="{{ url('') . '/admin/product-detail/' . $product->id }}">
                                                <i
                                                    class="btn-circle mr-4 ml-4 btn-sm btn-secondary fas fa-project-diagram"></i>
                                            </a>

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <p>Products Are Not Available .</p>
                                            <a href="{{ '/product/edit' }}" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Product</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
