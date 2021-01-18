<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
{{--        <img class="app-sidebar__user-avatar" src="http://placeimg.com/50/50/nature/sepia" alt="User Image">--}}
        <div>
            <span class="app-sidebar__user-name text-white">{{ auth()->user()->username }}</span>
        </div>
    </div>
    <ul class="app-menu">

        <li>
            <a class="app-menu__item {{ isActive('panel') }}" href="{{ route('panel') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">پنل مدیریت</span>
            </a>
        </li>

        @component( 'moduleMenu::layouts.menu-item' ) @endcomponent

        @if(auth()->user()->is_admin || auth()->user()->hasRole(['programmer', 'admin']))
            <li class="treeview {{ isActive( ['roles-assignment.index', 'roles.index', 'permissions.index'], 'is-expanded' ) }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">کاربران و دسترسی‌ها</span>
                    <i class="treeview-indicator fa fa-angle-left"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item pl-3 {{ isActive('roles-assignment.index') }}" href="{{ route('roles-assignment.index') }}"><i class="icon fa fa-circle-o"></i>کاربران</a></li>
                    <li><a class="treeview-item pl-3 {{ isActive('roles.index') }}" href="{{ route('roles.index') }}"><i class="icon fa fa-circle-o"></i>نقش‌ها</a></li>
                    <li><a class="treeview-item pl-3 {{ isActive('permissions.index') }}" href="{{ route('permissions.index') }}"><i class="icon fa fa-circle-o"></i>‌دسترسی‌ها</a></li>
                </ul>
            </li>
        @endif

        <li class="treeview {{ isActive( ['menu.index'], 'is-expanded' ) }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-bars"></i>
                <span class="app-menu__label">منوها</span>
                <i class="treeview-indicator fa fa-angle-left"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item pl-3 {{ isActive('menu.index') }}" href="{{ route('menu.index') }}"><i class="icon fa fa-circle-o"></i>منو ادمین</a></li>
            </ul>
        </li>

    </ul>
</aside>
