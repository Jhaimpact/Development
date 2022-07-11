@extends('layout.master')
@section('title', 'Manage-Menu')
@section('body')
    @php
    $name = $result->menu_name ?? (old('menu_name') ?? '');
    $parent = $result->parent_id ?? (old('parent_id') ?? '');
    $icon = $result->menu_icon ?? (old('menu_icon') ?? '');
    $href = $result->menu_href ?? (old('menu_href') ?? '');
    $permission_str = $result->permissions ?? (old('permissions.*') ?? '');
    $permission = $permission_str ? explode(',', $permission_str) : [];
    @endphp

    {{-- Geneate Header Buttons --}}
    <x-generate-header :createbutton=0 />
    {{-- {{ print_r($permission) }} --}}

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="p-5">

                <form class="user" method="POST" action="{{ url()->current() }}">
                    @csrf
                    @if ($result != null)
                        @method('put')
                    @endif

                    <div class="form-group">
                        <input type="text" class="form-control " id="exampleInputEmail" name="menu_name"
                            value="{{ $name }}" placeholder="Menu name">
                    </div>
                    <div class="form-group">
                        <select name="parent_id" class="form-control">
                            <option value="0" selected>--select one parent menu--</option>
                            @foreach ($parent_menu as $menu)
                                {{-- @if ($menu->id != $parent) --}}
                                    <option value="{{ $menu->id }}" {{ $menu->id == $parent ? 'selected' : '' }}>
                                        {{ $menu->menu_name }}
                                    </option>
                                {{-- @endif --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control " id="exampleInputEmail" name="menu_icon"
                            value="{{ $icon }}" placeholder="Menu icon ( class )">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control " id="exampleInputEmail" name="menu_href"
                            value="{{ $href }}" placeholder="hyper reference">
                    </div>
                    <div class="row">
                        <div class="col-12 mb-2">
                            Available Operations
                        </div>
                        <div class="form-group col">
                            <label for="view">View</label>
                            <input type="checkbox" id="view" {{ in_array(1, $permission) ? 'checked' : '' }}
                                name="permission[]" value="1">
                        </div>
                        <div class="form-group col">
                            <label for="create">Create</label>
                            <input type="checkbox" id="create" {{ in_array(2, $permission) ? 'checked' : '' }}
                                name="permission[]" value="2">
                        </div>
                        <div class="form-group col">
                            <label for="edit">Edit</label>
                            <input type="checkbox" id="edit" {{ in_array(3, $permission) ? 'checked' : '' }}
                                name="permission[]" value="3">
                        </div>
                        <div class="form-group col">
                            <label for="delete">Delete</label>
                            <input type="checkbox" id="delete" {{ in_array(4, $permission) ? 'checked' : '' }}
                                name="permission[]" value="4">
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>

                </form>
                <hr>
            </div>
        </div>
    </div>


@endsection
