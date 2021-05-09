@component('panel.layouts.component', ['title' => 'مدیریت منوسایت'])

    @slot('style')
        <style>
            #site_menus_table td:hover{
                cursor:move;
            }
        </style>
    @endslot

    @slot('subject')
        <h1>
            <i class="fa fa-user"></i> مدیریت منوسایت
        </h1>
        <p>این بخش
            برای مدیریت منوسایت
            است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('menu-group.index') }}">گروه‌های منو</a></li>
        <li class="breadcrumb-item">مدیریت منوسایت</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'site-menu-edit', 'show' => 'show', 'title' => 'ویرایش منوسایت'])
                            @slot('body')
                                <form action="" method="POST" class="site_menus">
                                    @csrf
                                    <input type="hidden" name="menu_group" id="menu_group" class="menu_group" value="{{ $menu_group->id }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_title"><strong>گروه منو</strong></label>
                                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                                       value="{{ $menu_group->title }}" name="menu_group_title" id="menu_group_title" disabled>
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @component('vendor.ModuleMenu.components.front-menu.menu-creator', ['button_label' => 'منو', 'button_class' => 'btn btn-success', 'modal_title' => 'ایجاد/ویرایش منو', 'data_type' => "menu_item"])
                                            @endcomponent
                                        </div>
                                    </div>
                                    @component('components.table', ['id' => 'site_menus_table'])
                                        @slot('thead')
                                            <tr>
                                                <th>شناسه</th>
                                                <th>عنوان</th>
                                                <th>وضعیت</th>
                                                <th>عملیات</th>
                                            </tr>
                                        @endslot
                                        @slot('tbody')
                                            <tr class="has_menus">
                                                <td class="text-center" colspan="5">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="my-4">
                                                            <div class="spinner-border text-warning" role="status">
                                                                <span class="sr-only"></span>
                                                            </div>
                                                            <div class="mt-2">
                                                                لطفا منتظر بمانید...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endslot
                                    @endcomponent
                                </form>
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>

    @endslot


    @slot('script')
        <script>
            $(".menu_status").select2({
                theme: "bootstrap"
            });
        </script>
    @endslot

@endcomponent
