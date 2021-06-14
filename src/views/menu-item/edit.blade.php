@component('panel.layouts.component', ['title' => 'مدیریت آیتم ها'])

    @slot('style')
        <style>
            #site_menus_table td:hover{
                cursor:move;
            }
        </style>
    @endslot

    @slot('subject')
        <h1>
            <i class="fa fa-user"></i> مدیریت آیتم ها
        </h1>
        <p>این بخش
            برای مدیریت آیتم های منوسایت
            است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('front-menu.edit', $menu->id) }}">{{ $menu->title }}</a></li>
        <li class="breadcrumb-item">مدیریت آیتم ها</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'menu-item-edit', 'show' => 'show', 'title' => 'ویرایش آیتم ها'])
                            @slot('body')
                                <form action="" method="POST" class="site_menus">
                                    @csrf
                                    <input type="hidden" name="menu" id="menu" class="menu" value="{{ $menu->id }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_title"><strong>منو</strong></label>
                                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                                       value="{{ $menu->title }}" name="menu_group_title" id="menu_title" disabled>
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
                                            @component('vendor.ModuleMenu.components.menu-item.menu-item-creator', ['button_label' => 'آیتم منو', 'button_class' => 'btn btn-success', 'modal_title' => 'ایجاد/ویرایش آیتم منو', 'data_type' => "menu_item_modal"])
                                            @endcomponent
                                        </div>
                                    </div>
                                    @component('components.table', ['id' => 'menu_items_table'])
                                        @slot('thead')
                                            <tr>
                                                <th>شناسه</th>
                                                <th>عنوان</th>
                                                <th>والد</th>
                                                <th>نوع</th>
                                                <th>وضعیت</th>
                                                <th>عملیات</th>
                                            </tr>
                                        @endslot
                                        @slot('tbody')
                                            <tr class="has_menu_items">
                                                <td class="text-center" colspan="6">
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
            $(".status").select2({
                theme: "bootstrap"
            });
            $(".type").select2({
                theme: "bootstrap"
            });
            $(".parent_id").select2({
                theme: "bootstrap"
            });
        </script>
    @endslot

@endcomponent
