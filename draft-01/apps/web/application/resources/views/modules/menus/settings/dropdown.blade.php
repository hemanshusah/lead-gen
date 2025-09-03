@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li data-modular-id="{{ $menu['id'] }}" class="sidenav-menu-item has-submenu"
    data-dropdown-menu-wrapper="{{ $menu['id'] }}">
    <a class="has-arrow waves-effect waves-dark {{ $menu['class'] }}" href="javascript:void(0);" aria-expanded="false"
        id="{{ $menu['id'] }}">
        <span class="hide-menu">{{ $menu['title'] }}
        </span>
    </a>
    <ul aria-expanded="false" class="collapse">
        @foreach($menu['data'] as $submenu)
        @if($submenu['visible'])
        <li class="sidenav-submenu">
            <a href="{{ $submenu['href'] }}" class="{{ $submenu['class'] }}"
                @include('modules.menus.misc.data-attributes') id="{{ $submenu['id'] }}" target="{{ $submenu['target'] }}">{{ $submenu['title'] }}
            </a>
        </li>
        @endif
        @endforeach
    </ul>
</li>
@endif