@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li class="nav-item" data-dropdown-menu-wrapper="{{ $menu['id'] }}">
    <a class="nav-link tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $menu['class'] }}" 
        id="{{ $menu['id'] }}"
        data-toggle="{{ $menu['data-toggle'] }}" 
        data-loading-class="{{ $menu['data-loading-class'] }}"
        data-loading-target="{{ $menu['data-loading-target'] }}" 
        data-dynamic-url="{{ $menu['data-dynamic-url'] }}"
        data-url="{{ $menu['data-url'] }}" 
        href="{{ $menu['href'] }}" 
        role="tab">{{ $menu['title'] }}
    </a>
</li>
@endif