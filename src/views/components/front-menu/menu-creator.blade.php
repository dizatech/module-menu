<span class="{{ $button_class }} new_menu" data-toggle="modal" data-target="#{{ $data_type }}" data-type="{{ $data_type }}">
        <i class="fa fa-plus"></i>
        {{ $button_label }}
    </span>
@component('vendor.ModuleMenu.components.front-menu.menu-modal', ['modal_id' => $data_type, 'modal_title' => $modal_title, 'field_type' => $data_type])
@endcomponent
