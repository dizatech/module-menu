@forelse($menus as $menu)
    <li class="side_menu menu-item">
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
                                <div class="mega-menu d-flex">
                                    @foreach($active_menu_item->children as $child)
                                        @if($child->type == 'div')
                                            
                                        @endif
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
                                            @foreach($child->children as $item)
                                                <li class="menu-item">
                                                    <a href="{{ is_null($item->url) ? '#' : $item->url }}">
                                                        <span class="fa fa-angle-left fa-fw"></span>{{ $item->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
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
