
@extends('layout.master')
@section('title', 'Customer')
@section('body')

    <x-generate-header :createbutton=0/>
    <div class="row">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->contact }}</td>
                                        <td>
                                            <x-generate-button iname="{{ $user->name }}" id="{{ $user->id }}" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p>Empty User</p>
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
                        {{-- $result->links() --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
