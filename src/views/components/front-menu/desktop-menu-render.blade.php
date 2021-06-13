@forelse($menus as $menu)
    @php

    @endphp
    <li class="{{ count($menu->active_menu_items) > 0 ? 'menu_dropdown' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-6603">
        <a href="#">
            {{ $menu->title }}
        </a>
    </li>
@empty

@endforelse
