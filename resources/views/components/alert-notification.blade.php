<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
@php
$alertType = session('success') ? 'primary' : (session('error') || (isset($errors) && $errors->any()) ? 'danger' : '');
if ($alertType == '') {
    return;
}
@endphp
<div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
    @if (session('success'))
        {{ session('success') }}
    @elseif (session('error'))
        {{ session('error') }}
    @elseif ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
