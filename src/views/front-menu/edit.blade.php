@component('panel.layouts.component', ['title' => 'ویرایش منو'])

    @slot('style')
    @endslot

    @slot('subject')
        <h1>
            <i class="fa fa-user"></i> ویرایش منو
        </h1>
        <p>این بخش
            برای ویرایش منو
            است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">منو ادمین</a></li>
        <li class="breadcrumb-item">ویرایش منو</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'menu-edit', 'show' => 'show', 'title' => 'ویرایش منو'])
                            @slot('body')
                                <form method="POST"
                                      action="{{ route('menu.update', $menu) }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="title"><strong>عنوان</strong></label>
                                                <input class="form-control  @error('title') is-invalid @enderror"
                                                       name="title" id="title" value="{{ old('title', $menu->title) }}"
                                                       autocomplete="off">

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="name"><strong>نام</strong></label>
                                                <input id="name" type="text" style="direction: ltr"
                                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                                       value="{{ old('name', $menu->name) }}" autocomplete="off">

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="icon"><strong>آیکون</strong></label>
                                                <input class="form-control  @error('icon') is-invalid @enderror"
                                                       name="icon" id="icon" type="text" style="direction: ltr"
                                                       value="{{ old('icon', $menu->icon) }}"
                                                       autocomplete="off">

                                                @error('icon')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="route"><strong>مسیر</strong></label>
                                                <input id="route" type="text" style="direction: ltr"
                                                       class="form-control @error('route') is-invalid @enderror" name="route"
                                                       value="{{ old('route', $menu->route) }}" autocomplete="off">

                                                @error('route')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-primary">
                                                <label for="parent_id"><strong>منو اصلی</strong></label>
                                                <select name="parent_id" id="parent_id"
                                                        class="form-control select2 @error ('parent_id') is-invalid @enderror">
                                                    <option value="0">انتخاب نمایید</option>
                                                    @foreach($menus as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('parent_id', $menu->parent_id) == $item->id ? 'selected' : '' }}>{{$item->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mb-2"><strong>نقش‌ها</strong></p>
                                    <div class="mb-4">
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-md-3 mb-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               name="roles[]"
                                                               value="{{$role->id}}"
                                                               {!! $menu->roles()->where('role_id' , $role->id)->count() > 0 ? 'checked' : '' !!}
                                                               class="custom-control-input"
                                                               id="{{ 'role'.$role->id  }}">
                                                        <label class="custom-control-label" for="{{ 'role'.$role->id  }}">{{$role->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if ($permissions)
                                        <p class="mb-2"><strong>دسترسی‌ها</strong></p>
                                        <div class="mb-4">
                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-md-3 mb-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                   name="permissions[]"
                                                                   value="{{$permission->id}}"
                                                                   {!! $menu->permissions()->where('permission_id' , $permission->id)->count() > 0 ? 'checked' : '' !!}
                                                                   class="custom-control-input"
                                                                   id="{{ 'permission'.$permission->id  }}">
                                                            <label class="custom-control-label" for="{{ 'permission'.$permission->id  }}">{{$permission->name}}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="py-3">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </div>
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
            $(".select2").select2({
                theme: "bootstrap"
            });
        </script>
    @endslot

@endcomponent
