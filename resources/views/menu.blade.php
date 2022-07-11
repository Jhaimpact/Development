@extends('layout.master')
@section('title', 'Menu')
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
                                    <th>Href</th>
                                    <th>Parent Menu</th>
                                    <th>Icon</th>
                                    <th>Operation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $menu)
                                    <tr>
                                        <td>{{ $menu->menu_name }}</td>
                                        <td>{{ $menu->menu_href }}</td>
                                        <td>{{ $menu->menu->menu_name ?? 'parent' }}</td>
                                        <td>{{ $menu->menu_icon }}</td>
                                        <td>{{ $menu->permissions }}</td>

                                        <td>
                                            <x-generate-button iname="{{ $menu->menu_name }}" id="{{ $menu->id }}" />
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p>Menus Are Not Available .</p>
                                            <a href="{{ '/menu/edit' }}" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Menu</span>
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
