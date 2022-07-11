<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
<div class="card">
    <div class="card-body ">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <a class="btn btn-circle btn-primary" href="{{ url()->previous() }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <p>{{ $create_button }}</p>
                @if ($create_button && $auth)
                    {{ $auth . 'hello' }}
                    <a href="{{ url()->current() }}/edit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add New {{ Str::ucfirst(request()->segment(1)) }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
