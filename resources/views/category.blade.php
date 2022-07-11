@extends('layout.master')
@section('title', 'Category')
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
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $category)
                                    <tr>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->parentCategory->category_name ?? 'parent' }}</td>
                                        <td>{{ $category->category_status ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $category->is_featured ? 'Featured' : 'Not Featured' }}</td>
                                        <td>
                                            <x-generate-button iname="{{ $category->category_name }}"
                                                id="{{ $category->id }}" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p>Categoirs Are Not Available .</p>
                                            <a href="{{ base_path('category/edit') }}"
                                                class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Category</span>
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
