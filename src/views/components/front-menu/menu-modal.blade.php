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
                    
                    <input type="hidden" name="menu_id" value="0" class="menu_id">

                </div>
            </div>
        </div>
    </div>
@endslot
@slot('footer')
    <button class="btn btn-success add_menu" data-type="{{ $field_type }}" data-modal="{{ $modal_id }}">ثبت</button>
@endslot
@endcomponent
