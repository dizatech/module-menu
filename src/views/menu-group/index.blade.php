@component('panel.layouts.component', ['title' => 'منو سایت - گروه‌های منو'])

    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> منو سایت - گروه‌های منو </h1>
        <p>مدیریت منو سایت - گروه‌های منو.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"> لیست گروه‌های منو </li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'menu-groups-index', 'show' => 'show', 'title' => 'لیست گروه‌های منو'])
                            @slot('body')
                                @component('components.collapse-search')
                                    @slot('form')
                                        <form class="clearfix">
                                            <div class="form-group">
                                                <label for="text-name-input">عنوان منو</label>
                                                <input type="text" class="form-control" id="text-name-input" name="keyword" value="{{request('keyword')}}">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-left">جستجو</button>
                                        </form>
                                    @endslot
                                @endcomponent

                                @component('components.table')
                                    @slot('thead')
                                        <tr>
                                            <th>شناسه</th>
                                            <th>عنوان</th>
                                            <th>وضعیت</th>
                                            <th>فعالیت</th>
                                        </tr>
                                    @endslot
                                    @slot('tbody')
                                        @forelse ($menu_groups as $menu_group)
                                            <tr>
                                                <td>
                                                    {{$menu_group->getKey()}}
                                                </td>
                                                <td>
                                                    {{$menu_group->title}}
                                                </td>
                                                <td>
                                                    {{$menu_group->status}}
                                                </td>
                                                <td>
                                                    <a  href="{{route('front-menu.edit', $menu_group->id)}}"
                                                        class="btn btn-sm btn-success">
                                                        مدیریت منوها
                                                    </a>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">موردی برای نمایش وجود ندارد.</td>
                                            </tr>
                                        @endforelse
                                    @endslot
                                @endcomponent

                                {{--Paginate section--}}
                                {{ $menu_groups->withQueryString()->links() }}
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
    @endslot

@endcomponent
