@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<a class="dropdown-item dropdown-item-iconed {{ $menu['class'] }}" href="{{ $menu['href'] }}" aria-expanded="false"
    @include('modules.menus.misc.data-attributes') id="{{ $menu['id'] }}" target="{{ $menu['target'] }}">
    <i class="{{ $menu['icon'] }}"></i> 
    {{ $menu['title'] }}
</a>
@endif