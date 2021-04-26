@component('panel.layouts.component', ['title' => 'منو ادمین'])

    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> منو ادمین </h1>
        <p>مدیریت منو ادمین.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"> لیست منوها </li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'menu-index', 'show' => 'show', 'title' => 'لیست منوها'])
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

                                <div class="mt-4">
                                    <a href={{ route('menu.create') }} type="button" class="btn btn-primary"><i class="fa fa-plus"></i> ایجاد منو</a>
                                </div>

                                @component('components.table')
                                    @slot('thead')
                                        <tr>
                                            <th>شناسه</th>
                                            <th>عنوان</th>
                                            <th>نام</th>
                                            <th>فعالیت</th>
                                        </tr>
                                    @endslot
                                    @slot('tbody')
                                        @forelse ($menus as $menu)
                                            <tr>
                                                <td>
                                                    {{$menu->getKey()}}
                                                </td>
                                                <td>
                                                    {{$menu->title}}
                                                </td>
                                                <td>
                                                    {{$menu->name}}
                                                </td>
                                                <td>
                                                    <a  href="{{route('menu.edit', $menu->id)}}"
                                                        class="btn btn-sm btn-success">
                                                        ویرایش اطلاعات
                                                    </a>
                                                    <a  href="#"
                                                        class="btn btn-sm btn-danger destroy_ajax" data-id="{{$menu->id}}">
                                                        حذف
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
                                {{ $menus->withQueryString()->links() }}
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
        <script>
            $(".destroy_ajax").on('click', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'آیا برای حذف اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'btn btn-danger mx-2',
                        cancelButton: 'btn btn-light mx-2'
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'لغو',
                    showClass: {
                        popup: 'animated fadeInDown'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp'
                    }
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "delete",
                                url: baseUrl + '/panel/menu/' + id,
                                dataType: 'json',
                                success: function (response) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: 'عملیات حذف با موفقیت انجام شد.',
                                        confirmButtonText:'تایید',
                                        customClass: {
                                            confirmButton: 'btn btn-success',
                                        },
                                        buttonsStyling: false,
                                        showClass: {
                                            popup: 'animated fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animated fadeOutUp'
                                        }
                                    })
                                        .then((response) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        </script>
    @endslot

@endcomponent
