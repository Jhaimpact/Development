@extends('layout.master')
@section('title', 'Manage-Category')
@section('body')
    @php
    $name = $result->category_name ?? (old('name') ?? '');
    $parent = $result->parent_id ?? (old('parent') ?? '');
    $status = $result->category_status ?? (old('status') ?? '');
    $is_featured = $result->is_featured ?? (old('is_featured') ?? '');
    @endphp

    {{-- Geneate Header Buttons --}}
    <x-generate-header :createbutton=0 />
           <div class="row justify-content-center">
                <div class="col-lg-9 mt-2">
                    <div class="card">
                        <div class="card-body">
                   
                            <form class="user" method="POST" enctype="multipart/form-data" action="{{ url('admin/category') }}">
                                @csrf
                                @if ($result != null)
                                    @method('put')
                                    <input type="hidden" name='id' value='{{$result->id ?? 0}}'>
                                @endif
                                <div class="form-row">

                                    <div class="form-group col-6">
                                        <label for="">Category Name</label>
                                        <input type="text" class="form-control " id="exampleInputEmail" name="name"
                                            value="{{ $name }}" placeholder="Cateogry">
                                    </div>
                                  
                                    <div class="form-group col-6">
                                        <label for="">Category Parent</label>
                                        
                                        <select name="parent" class="form-control">
                                            <option value="0" selected>--select one--</option>
                                            @foreach ($categories as $category)
                                                @if ($category->id != request()->segment(3))
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $parent ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>  

                                <div class="form-row">
            
                                    <div class="form-group col-6">

                                        <label for=""> Category Icon</label>
                                        <input type="file" name="category_icon" class="dropify form-control">
                                    
                                    </div>

                                    <div class="form-group col-6">

                                        <label for="">Category Image</label>
                                        <input type="file" name="category_image" class="dropify form-control">

                                    </div>

                                </div>      

                                <div class="form-row d-flex justify-content-center">
                                   <div class="col-6 text-center">

                                                <input type="checkbox" {{ $status == '1' ? 'checked' : '' }} name="status"
                                                    value="1" id="customCheck">
                                                <label  for="customCheck">Active</label>
                                                <input type="checkbox" {{ $is_featured == '1' ? 'checked' : '' }} name="is_featured"
                                                    value="1" id="customFeature">
                                                <label  for="customFeature">Featured</label>
                                        
                                   </div>
                                </div>   
                                
                                <div class="form-row ">
                                    <div class="form-group col-12 text-center">
                                        <a href="{{url('category')}}" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                        <button class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>

                            </form>
                            <hr>
                        </div>
                  </div>
        
                </div>
            </div>


@endsection
