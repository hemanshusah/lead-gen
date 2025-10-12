@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li class="nav-item dropdown" data-modular-id="{{ $menu['id'] }}">
    <a class="nav-link dropdown-toggle waves-effect waves-dark {{ $menu['class'] }} font-22 p-t-10 p-r-10" href="javascript:void(0)" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" id="{{ $menu['id'] }}">
        <i class="{{ $menu['icon'] }}"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">

        @foreach($menu['data'] as $submenu)
        @if($submenu['visible'])
        <a class="dropdown-item {{ $menu['class'] }}" href="{{ $submenu['href'] }}"  aria-expanded="false"
            @include('modules.menus.misc.data-attributes') id="{{ $submenu['id'] }}" target="{{ $submenu['target'] }}">
            {{ $submenu['title'] }}
        </a>
        @endif
        @endforeach

    </div>
</li>
@endif