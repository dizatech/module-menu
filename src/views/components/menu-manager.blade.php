<li class="treeview {{ isActive( ['menu.index','front-menu.index'], 'is-expanded' ) }}">
    <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-bars"></i>
        <span class="app-menu__label">منوها</span>
        <i class="treeview-indicator fa fa-angle-left"></i>
    </a>
    <ul class="treeview-menu">
        <li><a class="treeview-item pl-3 {{ isActive('menu.index') }}" href="{{ route('menu.index') }}"><i class="icon fa fa-circle-o"></i>منو ادمین</a></li>
        <li><a class="treeview-item pl-3 {{ isActive('front-menu.index') }}" href="{{ route('menu-group.index') }}"><i class="icon fa fa-circle-o"></i>منو سایت</a></li>
    </ul>
</li>
