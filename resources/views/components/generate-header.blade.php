<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
@php
$page_name = Str::replace('-', ' ', Str::ucfirst(request()->segment(2)));
@endphp
<div class="card">
    <div class="card-body ">
        <div class="row justify-content-between">
            <div class="col-4">
                <a class="btn btn-circle btn-primary" href="{{ url()->previous() }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="col-4">
                <h5 class="mt-2 text-center">{{ (!$createbutton ? 'Manage ' : '') . $page_name }}</h5>
            </div>
            <div class="col-4 text-right">
                @if ($createbutton)
                    @can('create-auth')
                        <a href="{{ url()->current() }}/manage" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            {{-- <span class="text">Add New {{ Str::ucfirst(Request::segment(1)) }}</span> --}}
                            <span class="text">Add New
                                {{ $page_name }}</span>
                        </a>
                    @endcan
                @endif
            </div>
        </div>
    </div>
</div>
