@extends('layout.master')
@section('title', 'Manage-System-Users')
@section('body')
    @php
        $name = $result->name ?? (old('name') ?? '');
        $email = $result->email ?? (old('email') ?? '');
        $role_id = $result->role_id ?? (old('role_id') ?? '');
        $status = $result->status ?? (old('status') ?? '');
        $contact = $result->contact ?? (old('contact') ?? '');
    @endphp

    {{-- Geneate Header Buttons --}}
    <x-generate-header :createbutton=0 />
           <div class="row justify-content-center">
                <div class="col-lg-9 mt-2">
                    <div class="card">
                        <div class="card-body">
                   
                            <form class="user" method="POST"  action="{{ url('admin/system-user') }}">
                                @csrf
                                @if ($result != null)
                                    @method('put')
                                    <input type="hidden" name='id' value='{{$result->id ?? 0}}'>
                                @endif
                                <div class="form-row">

                                    <div class="form-group col-6">
                                        <label for="">User Name</label>
                                        <input type="text" class="form-control " id="exampleInputEmail" name="name"
                                            value="{{ $name }}" placeholder="User Name">
                                    </div>
                                  
                                    <div class="form-group col-6">
                                        <label for="">Role</label>
                                        
                                        <select name="role_id" class="form-control">
                                            <option value="0" selected>--select one--</option>
                                            @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role->id == $role_id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>  

                                <div class="form-row">
            
                                    <div class="form-group col-6">

                                        <label for=""> Email</label>
                                        <input type="email" value="{{$email}}" name="email" placeholder= "Email" class="form-control">
                                    
                                    </div>

                                    <div class="form-group col-6">

                                        <label for="">Contact</label>
                                        <input type="number" value="{{$contact}}" name="contact" placeholder="Contact" class="form-control">

                                    </div>

                                </div>    
                                @if (!$result)
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="">Passoword</label>
                                            <input type="password" name="password" placeholder= "Password" class="form-control">
                                        </div>
                                    </div>
                                @endif
                                

                         
                                <div class="form-row ">
                                    <div class="form-group col-12 text-center">
                                        <a href="{{url('admin/system-user')}}" class="btn btn-secondary">
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
