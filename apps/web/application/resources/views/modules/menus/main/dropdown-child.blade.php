@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li class="sidenav-submenu {{ $menu['class'] }}" data-menu-wrapper-id="{{ $menu['id'] }}">
    <a href="{{ $menu['href'] }}" class="{{ $menu['class'] }}" 
        @include('modules.menus.misc.data-attributes') id="{{ $menu['id'] }}" target="{{ $menu['target'] }}">{{ $menu['title'] }}
    </a>
</li>
@endif