@forelse($menus as $menu)
    <li class="side_menu menu-item {{ is_null($menu->css_class) ? '' : $menu->css_class }}">
        <a href="{{ is_null($menu->url) ? '#' : $menu->url }}">
            {{ $menu->title }}
        </a>
        @if(count($menu->active_menu_items) > 0)
            <ul class="header-main-menu-1st-child">
                @foreach($menu->active_menu_items as $active_menu_item)
                    <li class="menu-item {{ is_null($active_menu_item->css_class) ? '' : $active_menu_item->css_class }}">
                        <a href="{{ is_null($active_menu_item->url) ? '#' : $active_menu_item->url }}">
                            {{ $active_menu_item->title }}
                        </a>
                        @if(count($active_menu_item->children) > 0)
                            <div class="row">
                                <div class="mega-menu">
                                    @php
                                        $active_menu_item_children = $active_menu_item->children()->where('type', 'group')->get();
                                    @endphp
                                    @if(count($active_menu_item_children) > 0)
                                        @foreach($active_menu_item->children()->orderBy('sort_order', 'ASC')->get() as $child)
                                            @if($child->type == 'group')
                                                <div class="{{ is_null($child->css_class) ? '' : $child->css_class }} menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                                    <ul class="end-menu">
                                                        @foreach($child->children()->orderBy('sort_order', 'ASC')->get() as $item)
                                                            @if($item->type == 'heading')
                                                                <li>
                                                                    <h5>{{ $item->title }}</h5>
                                                                </li>
                                                                @foreach($item->children as $heading_child)
                                                                    <li class="menu-item {{ is_null($heading_child->css_class) ? '' : $heading_child->css_class }}">
                                                                        <a href="{{ is_null($heading_child->url) ? '#' : $heading_child->url }}">
                                                                            <span class="fa fa-angle-left fa-fw"></span>{{ $heading_child->title }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                <li class="menu-item {{ is_null($item->css_class) ? '' : $item->css_class }}">
                                                                    <a href="{{ is_null($item->url) ? '#' : $item->url }}">
                                                                        <span class="fa fa-angle-left fa-fw"></span>{{ $item->title }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                            @foreach($active_menu_item->children()->orderBy('sort_order', 'ASC')->get() as $child)
                                                <ul class="end-menu">
                                                    @if($child->type == 'heading')
                                                        <li>
                                                            <h5>{{ $child->title }}</h5>
                                                        </li>
                                                    @else
                                                        <li class="menu-item">
                                                            <a href="{{ is_null($child->url) ? '#' : $child->url }}">
                                                                <span class="fa fa-angle-left fa-fw"></span>{{ $child->title }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @foreach($child->children()->orderBy('sort_order', 'ASC')->get() as $item)
                                                        <li class="menu-item">
                                                            <a href="{{ is_null($item->url) ? '#' : $item->url }}">
                                                                <span class="fa fa-angle-left fa-fw"></span>{{ $item->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@empty

@endforelse
