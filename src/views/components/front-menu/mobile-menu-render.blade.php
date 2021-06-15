@forelse($menus as $menu)
    <li class="side_menu menu-item magz-dropdown {{ is_null($menu->css_class) ? '' : $menu->css_class }}">
        <a href="{{ is_null($menu->url) ? '#' : $menu->url }}">
            {{ $menu->title }}
        </a>
        @if(count($menu->active_menu_items) > 0)
            <ul class="dropdown-menu">
                @foreach($menu->active_menu_items as $active_menu_item)
                    <li class="menu-item magz-dropdown {{ is_null($active_menu_item->css_class) ? '' : $active_menu_item->css_class }}">
                        <a href="{{ is_null($active_menu_item->url) ? '#' : $active_menu_item->url }}">
                            {{ $active_menu_item->title }}
                        </a>
                        @if(count($active_menu_item->children) > 0)
                            @php
                                $active_menu_item_children = $active_menu_item->children()->where('type', 'group')->get();
                            @endphp
                            @if(count($active_menu_item_children) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($active_menu_item->children()->orderBy('sort_order', 'ASC')->get() as $item)
                                        @if ($item->type == 'group')
                                            @foreach($item->children()->orderBy('sort_order', 'ASC')->get() as $group_child)
                                                @if($group_child->type == 'heading')
                                                    <li>
                                                        <h5 class="text-right">
                                                            {{ $group_child->title }}
                                                        </h5>
                                                    </li>
                                                    @foreach($group_child->children as $heading_child)
                                                        <li class="menu-item {{ is_null($heading_child->url) ? '#' : $heading_child->url }}">
                                                            <a href="{{ is_null($heading_child->url) ? '#' : $heading_child->url }}">
                                                                {{ $heading_child->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="menu-item {{ is_null($group_child->css_class) ? '' : $group_child->css_class }}">
                                                        <a href="{{ is_null($group_child->url) ? '#' : $group_child->url }}">
                                                            {{ $group_child->title }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@empty

@endforelse
