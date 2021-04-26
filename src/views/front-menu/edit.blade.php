@component('panel.layouts.component', ['title' => 'مدیریت منوسایت'])

    @slot('style')
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
                        @component('components.collapse-card', ['id' => 'menu-edit', 'show' => 'show', 'title' => 'ویرایش منوسایت'])
                            @slot('body')

                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>

    @endslot


    @slot('script')
        <script>
            $(".select2").select2({
                theme: "bootstrap"
            });
        </script>
    @endslot

@endcomponent
