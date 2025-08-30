@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li class="nav-item dropdown" data-dropdown-menu-wrapper="{{ $menu['id'] }}">
    <a class="nav-link dropdown-toggle tabs-menu-item {{ $menu['class'] }}" data-toggle="dropdown"
        id="{{ $menu['id'] }}" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="hidden-xs-down">{{ $menu['title'] }}</span>
    </a>
    <div class="dropdown-menu" x-placement="bottom-start">
        @foreach($menu['data'] as $submenu)
        @if($submenu['visible'])
        <a class="dropdown-item {{ $menu['class'] }}" id="{{ $menu['id'] }}"
            data-toggle="{{ $menu['data-toggle'] }}" 
            data-loading-class="{{ $submenu['data-loading-class'] }}" 
            data-loading-target="{{ $submenu['data-loading-target'] }}"
            data-dynamic-url="{{ $submenu['data-dynamic-url'] }}"
            data-url="{{ $submenu['data-url'] }}"
            href="{{ $submenu['href'] }}" 
            role="tab">{{ $submenu['title'] }}</a>
        @endif
        @endforeach
    </div>
</li>
@endif