<span class="{{ $button_class }} new_menu_item" data-toggle="modal" data-target="#{{ $data_type }}" data-type="{{ $data_type }}">
        <i class="fa fa-plus"></i>
        {{ $button_label }}
    </span>
@component('vendor.ModuleMenu.components.menu-item.menu-item-modal', ['modal_id' => $data_type, 'modal_title' => $modal_title, 'field_type' => $data_type])
@endcomponent
