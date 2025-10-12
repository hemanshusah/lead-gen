@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<a class="dropdown-item {{ $menu['class'] }}" 
    id="{{ $menu['id'] }}" 
    data-toggle="{{ $menu['data-toggle'] }}"
    data-loading-class="{{ $menu['data-loading-class'] }}"
    data-loading-target="{{ $menu['data-loading-target'] }}" 
    data-dynamic-url="{{ $menu['data-dynamic-url'] }}"
    data-url="{{ $menu['data-url'] }}" 
    href="{{ $menu['href'] }}" 
    role="tab">{{ $menu['title'] }}
</a>
@endif