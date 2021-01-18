@foreach( app('Module')->get_enabled_modules() as $module )
    @foreach( $module['admin_links'] as $admin_link )
        @if( !isset( $admin_link['children'] ) || count( $admin_link['children'] ) == 0 )
            <li class="@php
                if( isset( $admin_link['classes'] ) && !empty( $admin_link['classes'] ) ){
                    echo implode( " ", $admin_link['classes'] );
                }
            @endphp">
                <a class="app-menu__item {{ isActive( $admin_link['route'] ) }}" href="{{ route( $admin_link['route'] ) }}">
                    <i class="app-menu__icon {{ $admin_link['icon'] }}"></i>
                    <span class="app-menu__label">{{ $admin_link['title'] }}</span>
                </a>
            </li>
        @else
            <li class="treeview @php
                if( isset( $admin_link['classes'] ) && !empty( $admin_link['classes'] ) ){
                    echo implode( " ", $admin_link['classes'] );
                }
                @endphp {{ isActive( $module['route_names'], 'is-expanded' ) }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon {{ $admin_link['icon'] }}"></i>
                    <span class="app-menu__label">{{ $admin_link['title'] }}</span>
                    <i class="treeview-indicator fa fa-angle-left"></i>
                </a>
                <ul class="treeview-menu">
                    @foreach( $admin_link['children'] as $child )
                        @if( !isset( $child['visible'] ) || $child['visible'] !== false )
                            <li class="@php
                                if( isset( $child['classes'] ) && !empty( $child['classes'] ) ){
                                    echo implode( " ", $child['classes'] );
                                }
                            @endphp">
                                <a class="treeview-item pl-3 {{ isActive( $child['route'] ) }}" href="{{ route( $child['route'] ) }}">
                                    <i class="icon fa fa-circle-o"></i>{{ $child['title'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach
@endforeach
