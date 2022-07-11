@extends('layout.master')
@section('title', 'Manage-Product-Detail')
@php
$size = $result['size'] ?? '';
$color_code = $result['color_code'] ?? '';
$quantity = $result['quantity'] ?? '';
$detail_image = $result['detail_image'] ?? '';
@endphp
@section('body')
    <x-generate-header :createbutton=0 />
    @if (!$result)
        <div class="d-flex justify-content-end">
            <button class="btn btn-info add_meta_btn" type="button"><b>+</b> Add New Product Size</button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8 p-5">
            <form action="{{ url()->current() }}" method="POST" class="user" enctype="multipart/form-data">
                @csrf
                @if ($result != null)
                    @method('put')
                @endif
                <div id="form_container">
                    <div class="card detail_container">
                        <div class="card-body">


                            <div class="row justify-content-center">
                                <div class="col-md-5 col-sm-12 form-group">
                                    <select class="form-control" required name=" data[0][size]">
                                        <option value="1" {{ $size == 1 ? 'selected' : '' }}>xs</option>
                                        <option value="2" {{ $size == 2 ? 'selected' : '' }}>sm</option>
                                        <option value="3" {{ $size == 3 ? 'selected' : '' }}>lg</option>
                                        <option value="4" {{ $size == 4 ? 'selected' : '' }}>xl</option>
                                        <option value="5" {{ $size == 5 ? 'selected' : '' }}>xxl</option>
                                    </select>
                                </div>
                                @if (!$result)
                                    <div title="add row" class="col-md-3 col-sm-12 form-group mt-1 button_box">
                                        <i class="btn-circle btn-danger btn-sm fas fa-plus add_row"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="meta_row_container">
                                <div class="row meta_row">
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <input required value="{{ $color_code }}" class="form-control" type="text"
                                            name="data[0][meta][0][color_code]" placeholder="hash color code">
                                    </div>
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <input required class="form-control" type="numeric" value="{{ $quantity }}"
                                            name="data[0][meta][0][quantity]" placeholder="quantity">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <input {{ $detail_image ? '' : 'required' }} class="form-control"
                                            accept="image/*" name="data[0][meta][0][detail_image]" type="file">
                                        @if ($detail_image)
                                            <img class="table-image mt-2 ml-4"
                                                src="{{ url('') . '/assets/productdetail/' . $detail_image }}" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-12 col-sm-12 form-group">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
