@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li class="nav-item" data-menu-wrapper-id="{{ $menu['id'] }}">
    <a class="nav-link waves-effect waves-dark font-22 p-t-10 p-r-10 {{ $menu['class'] }}" href="{{ $menu['href'] }}"  aria-expanded="false"
        @include('modules.menus.misc.data-attributes') id="{{ $menu['id'] }}" target="{{ $menu['target'] }}">
        <i class="{{ $menu['icon'] }}"></i>
    </a>
</li>
@endif