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
                    <div id="menu_data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label for="title"><strong>عنوان</strong></label>
                                    <input type='text' id='title' class='form-control' name='title' value='' />
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="css_class"><strong>کلاس css</strong></label>
                                    <input type='text' id='css_class' class='form-control' name='css_class' style="direction: ltr" value='' />
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url"><strong>url</strong></label>
                                    <input type='text' id='url' class='form-control' name='url' value='' style="direction: ltr" />
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label for="status"><strong>وضعیت</strong></label>
                                    <select name="menu_status" id="menu_status"
                                            class="form-control menu_status">
                                        <option value="0" selected>
                                            غیرفعال
                                        </option>
                                        <option value="1">
                                            فعال
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- menu inputs must be placed in here -->
                        <input type="hidden" name="menu_id" value="0" class="menu_id">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endslot
@slot('footer')
    <button class="btn btn-success add_menu" data-modal="{{ $modal_id }}">ثبت</button>
@endslot
@endcomponent
