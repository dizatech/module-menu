@component('components.modal', ['id' => $modal_id ,'title' => $modal_title , 'size' => 'modal-lg']) <!-- size(modal-xl, modal-lg, modal-sm, ) -->
@slot('body')
    <div class="form-group position-relative">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 assign_success"></div>
                        <div class="col-md-12 assign_error"></div>
                    </div>
                    <div id="menu_item_data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label for="type"><strong>نوع</strong></label>
                                    <select name="type" id="type"
                                            class="form-control type">
                                        <option value="choose">
                                            انتخاب کنید...
                                        </option>
                                        <option value="group" title="گروه">
                                            گروه
                                        </option>
                                        <option value="custom" title="منو سفارشی">
                                            منو سفارشی
                                        </option>
                                        <option value="heading" title="تیتر منو">
                                            تیتر منو
                                        </option>
                                        <option value="news" title="خبر">
                                            خبر
                                        </option>
                                        <option value="news_category" title="دسته‌بندی خبر">
                                            دسته‌بندی خبر
                                        </option>
                                        <option value="article" title="مقاله">
                                            مقاله
                                        </option>
                                        <option value="article_category" title="دسته‌بندی مقاله">
                                            دسته‌بندی مقاله
                                        </option>
                                        <option value="video" title="ویدیو">
                                            ویدیو
                                        </option>
                                        <!--
                                        <option value="video_category" title="دسته‌بندی ویدیو">
                                            دسته‌بندی ویدیو
                                        </option>
                                        -->
                                        <option value="service" title="خدمت">
                                            خدمت
                                        </option>
                                        <!--
                                        <option value="service_category" title="دسته‌بندی خدمت">
                                            دسته‌بندی خدمت
                                        </option>
                                        -->
                                        <option value="laboratory" title="آزمایشگاه">
                                            آزمایشگاه
                                        </option>
                                        <option value="equipment" title="تجهیزات">
                                            تجهیزات
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label for="status"><strong>وضعیت</strong></label>
                                    <select name="status" id="status"
                                            class="form-control status">
                                        <option value="">
                                            انتخاب کنید...
                                        </option>
                                        <option value="0">
                                            غیرفعال
                                        </option>
                                        <option value="1">
                                            فعال
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="css_class"><strong>کلاس css</strong></label>
                                    <input type='text' id='css_class' class='form-control' name='css_class' value='' />
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="text-danger"></span>
                                    <label for="parent_id"><strong>والد</strong></label>
                                    <select name="parent_id" id="parent_id"
                                            class="form-control parent_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 item_title" style="display: none">
                                <div class="form-group">
                                    <span class="text-danger title_required"></span>
                                    <label for="title"><strong>عنوان</strong></label>
                                    <input type='text' id='title' class='form-control' name='title' value='' />
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 item_url" style="display: none">
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label for="url"><strong>url</strong></label>
                                    <input type='text' id='url' class='form-control' name='url' value='' style="direction: ltr" />
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 object_container" style="display: none">
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label for="object_id" class="object_title"></label>
                                    <select name="object_id" id="object_id"
                                            class="form-control object_id">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="menu_item_id" value="0" class="menu_item_id">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endslot
@slot('footer')
    <button class="btn btn-success add_menu_item" data-modal="{{ $modal_id }}">ثبت</button>
@endslot
@endcomponent
