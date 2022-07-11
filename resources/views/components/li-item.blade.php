<li class="nav-item {{$component->menu_href == request()->segment(2) ? " active":""}}">
    <a class="nav-link" href="{{url('')."/admin/".$component->menu_href }}" >
        <i class="{{$component->menu_icon}}"></i>
        <span>{{$component->menu_name}}</span></a>
</li>