@extends('layout.master')
@section('title', 'Manage-Category')
@section('body')
    @php
    $name = $result->name ?? (old('name') ?? '');
    $status = $result->status ?? (old('status') ?? '');
    @endphp

    {{-- Geneate Header Buttons --}}
    <x-generate-header :createbutton=0 />
 
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="p-5">

                <form class="user" method="POST" action="{{url('admin/role')}}">
                    @csrf
                    @if ($result != null)
                        @method('put')
                        <input type="hidden" name = "id"  value="{{$result->id ?? ''}}" >
                    @endif

                    <div class="form-group">
                        <input type="text" class="form-control " id="exampleInputEmail" name="name"
                            value="{{ $name }}" placeholder="Role Name">
                    </div>
             
                    <div class="form-group text-center">
                        <label>
                            <input type="checkbox" {{$status?"checked":""}} name="status" value="1" id="customCheck"> Status
                        </label>
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
