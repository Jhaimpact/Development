@extends('layout.master')
@section('title', 'Manage-Permissions')
@php
$permission_array = ['1' => 'view', '2' => 'create', '3' => 'edit', '4' => 'delete'];
@endphp

@section('body')
    <x-generate-header :createbutton=0 />
    <div class="row">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="{{url('admin/permissions')}}">
                            @csrf
                            <table class="table table-bordered" style="text-transform: capitalize">
                                <thead>
                                    <tr>
                                        <th>Menus</th>
                                        @foreach ($role as $each)
                                            <th>{{ $each->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <th class="text-left bg-light" colspan=" {{ sizeof($role) + 1 }}">
                                                {{ $menu->menu_name }}</th>
                                        </tr>
                                        @foreach (explode(',', $menu->permissions) as $permission)
                                            <tr>
                                                @if ($permission)
                                                    <td>{{ $permission_array[$permission] }}</td>
                                                    @foreach ($role as $each)
                                                        <td>
                                                            @php
                                                                $check = $each
                                                                    ->permission()
                                                                    ->where('permission_id', $permission)
                                                                    ->where('menu_id', $menu->id)
                                                                    ->get();
                                                                // print_r($check);
                                                            @endphp
                                                            <input
                                                                name={{ 'data[' . $each->id . '_' . $menu->id . '_' . $permission . ']' }}
                                                                type="checkbox" value="0"
                                                                {{ $check->isNotEmpty() ? 'checked' : '' }} />
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="submit" class="btn btn-primary" value="Apply Permission" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
