@if(isset($menu['title']) && $menu['title'] != '' && $menu['visible'])
<li data-menu-wrapper-id="{{ $menu['id'] }}" class="sidenav-menu-item menu-with-tooltip"
    title="{{ $menu['title'] }}">
    <a class="waves-effect waves-dark" href="{{ $menu['href'] }}" aria-expanded="false" target="_self">
        <span class="hide-menu">{{ $menu['title'] }}</span>
    </a>
</li>
@endif