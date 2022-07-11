<div class="d-flex justify-content-center">
    @can('update-auth')
        <a href="{{ url()->current() }}/manage/{{ $id }}" title="edit">
            <i class="btn-circle mr-3 btn-sm btn-info fa fa-pen"></i>
        </a>
    @endcan
    @can('delete-auth')
        <i class="btn-circle btn-sm btn-danger fa fa-trash delete-item" style="cursor:pointer" c-name="{{ $iname }}"
            c-index="{{ $id }}" title="delete"></i>
    @endcan

</div>
