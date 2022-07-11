@extends('layout.master')
@section('title', 'Role')
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>

                                        <td>
                                            <x-generate-button iname="{{ $role->name }}" id="{{ $role->id }}" />
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p>Role Are Not Available .</p>
                                            <a href="{{ '/role/edit' }}" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Role</span>
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
