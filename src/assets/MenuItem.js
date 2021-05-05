let menu = $('.menu').val();

let not_information = '<tr class="not_information"><td class="text-center" colspan="5">موردی برای نمایش وجود ندارد</td></tr>';

let menu_item_loading = `
<tr class="has_menu_items">
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
`;

(function() {
    if (typeof menu != "undefined"){
        load_menu_item(false);
    }
})();

// start load menus from database
function load_menu_item(empty_table) {
    const menu_items_table = $('#menu_items_table tbody');
    if (empty_table == true){
        menu_items_table.html(menu_item_loading);
    }
    $.ajax({
        type: "post",
        url: baseUrl + '/panel/menu-item/get/menu-items/' + menu,
        dataType: 'json',
        success: function (response) {
            menu_items_table.find('.has_menu_items').hide(1000);
            setTimeout(function (){
                if (response.length > 0){
                    for( let i=0; i<response.length; i++ ){
                        add_menu_item_row( $('#menu_items_table tbody'), response[i].title, response[i].status_label, response[i].id );
                    }
                }else {
                    menu_items_table.append(not_information);
                }
            }, 1000);
        }
    });
}
// end load menus from database

// start add menus row after insert menus in ajax
function add_menu_item_row( target, menu_title, menu_status, menu_id ){
    target.append(
        "<tr class='list_row'>" +
        "<td>" + menu_id + " <input type='hidden' name='menu_item_ids[]' value='" + menu_id + "'></td>" +
        "<td>" + menu_title + " </td>" +
        "<td>" + menu_status + "</td>" +
        "<td>" +
        "<a href='#' data-id='"+menu_id+"' class='btn btn-sm btn-success edit_menu_item'>ویرایش</a>" +
        "<a href='#' data-id='"+menu_id+"' class='btn btn-sm btn-danger delete_menu_item ml-lg-1'>حذف</a>" +
        "</td>" +
        "</tr>"
    );
}
// end add menus row after insert menus in ajax

// start delete menu action
$('#menu_items_table').on('click', '.delete_menu_item', function (e) {
    e.preventDefault();

    const target = $(this);
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
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "delete",
                url: baseUrl + '/panel/menu-item/' + id,
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
                            target.closest('tr').remove();
                            hasMenuItem();
                        });
                }
            });


        }
    })
});
// end delete menu action

// start check if has not field then show not found
function hasMenuItem(){
    $.ajax({
        type: "post",
        url: baseUrl + '/panel/menu-item/get/menu-items/' + menu,
        dataType: 'json',
        success: function (response) {
            if (!response.length > 0){
                $('#menu_items_table tbody').append(not_information);
            }
        }
    });
}
// end check if has not field then show not found

$('.new_menu_item').on('click', function (e) {
    empty_inputs();
    $.ajax({
        url: baseUrl + '/panel/menu-item/get/menu-parents',
        dataType: 'json',
        success: function (response) {
            $('.parent_id').html(response.menu_parent);
        }
    });
});

// start add new menu ajax handler
$('.add_menu_item').on('click', function(e) {
    e.preventDefault();
    let menu_item_id = $('.menu_item_id').val();
    let modal_id = $(this).data('modal');
    $.ajax({
        type: 'patch',
        url: baseUrl + '/panel/menu-item/createOrUpdate/' + menu,
        data: $('#menu_item_data :input').serialize(),
        dataType: 'json',
        success: function (response) {
            $('.not_information').hide();
            $('.has_information').hide();
            if (menu_id == 0){
                add_menu_item_row($('#menu_items_table tbody'), response.title, response.status_label, response.id);
                empty_inputs();
            }else {
                hide_error_messages();
                if (response.status == 500){
                    show_error_message(modal_id,response.message);
                }else {
                    load_menu_item(true);
                    show_success_message(modal_id,response.message);
                }
            }
        },
        error: function (response) {
            hide_error_messages();
            show_error_messages(response);
        }
    });
});
// end new menu ajax handler

//start empty inputs
function empty_inputs(){
    $('#menu_item_data :input').val('');
    $(".menu_status").val(0);
    $(".menu_status").trigger('change');
}
//end empty inputs

// start hide menu error messages before and after ajax submit
function hide_error_messages(){
    $('.assign_success').html('');
    $('.assign_error').html('');
    $('.form-group')
        .find('.invalid-feedback')
        .addClass('d-none')
        .find('strong').text('');
    $('.form-group')
        .find('.is-invalid')
        .removeClass('is-invalid');
    $(".status").trigger('change');
    $('.form-group').find('.select2-hidden-accessible').next().find('.select2-selection').removeClass('is-invalid-select2');
    $('.form-group').find('.select2-hidden-accessible').next().find('+ span').remove();
}
// end hide menu error messages before and after ajax submit

// start show success messages for ajax request
function show_success_message(modal_id,message){
    $('#' + modal_id).find('.assign_success').text('');
    $('#' + modal_id).find('.assign_success').html(
        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
        message +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>'
    );
}
// end show success messages for ajax request

// start show success messages for ajax request
function show_error_message(modal_id,message){
    $('#' + modal_id).find('.assign_error').text('');
    $('#' + modal_id).find('.assign_error').html(
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
        message +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>'
    );
}
// end show success messages for ajax request

// start show error messages for ajax menu
function show_error_messages(res){
    let response = res;
    $('.form-group')
        .find('.invalid-feedback')
        .addClass('d-none')
        .find('strong').text('');
    $('.form-group')
        .find('.is-invalid')
        .removeClass('is-invalid')
    if (response.status === 422) {
        for( const field_name in response.responseJSON.errors ){
            if(response.responseJSON.errors[field_name]) {
                let target = $('[name=' + field_name + ']');
                target.addClass('is-invalid');
                target.closest('.form-group')
                    .find('.invalid-feedback')
                    .removeClass('d-none')
                    .find('strong').text(response.responseJSON.errors[field_name]);
                if (target.hasClass('select2-hidden-accessible')){
                    target.next().find('.select2-selection').addClass('is-invalid-select2');
                    target.next().after('<span class="invalid-feedback d-block" role="alert"><strong>'+response.responseJSON.errors[field_name]+'</strong></span>');
                }
            }
        }
    }
}
// end show error messages for ajax menu

// start menus table sort method
let menus_table = $("#menu_items_table tbody");
var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
};
updateIndex = function() {
    let menus = [];
    $('input[name^="menu_item_ids"]').each(function(i) {
        if ( ! $(this).val() == '' ){
            menus[i] = $(this).val();
        }
    });
    $.ajax({
        type: 'post',
        url: baseUrl + '/panel/menu-item/sort',
        data: {
            menu_ids : menus
        },
        dataType: 'json',
        success: function (response) {
            alertify.success("منوها مرتب‌سازی شد.");
        },
        error: function (response) {
            show_error_messages(response);
        }
    });
};

menus_table.sortable({
    helper: fixHelperModified,
    stop: updateIndex
}).disableSelection();

menus_table.sortable({
    distance: 5,
    delay: 100,
    opacity: 0.6,
    cursor: 'move',
    update: function() {}
});
// end menus table sort method

// start edit menu action
$('#menu_items_table').on('click', '.edit_menu_item', function (e) {
    e.preventDefault();
    let menu = $(this).data('id');
    $.ajax({
        type: 'post',
        url: baseUrl + '/panel/menu-item/get/menu-item',
        data: {
            menu_id : menu
        },
        dataType: 'json',
        success: function (response) {
            empty_inputs();
            hide_error_messages();
            $('#menu_item_modal').modal('show');
            $('#title').val(response.title);
            $('#css_class').val(response.css_class);
            $(".menu_status").val(response.menu_status);
            $(".menu_status").trigger('change');
            $('.menu_item_id').val(response.menu_id);
        },
        error: function (response) {
            alertify.error("یک خطا غیرمنتظره رخ داد !");
        }
    });
});
// end edit field action

$('.type').on('change', function () {
    switch ($(this).val()) {
        case 'custom':
            $('.item_title').show('.5');
            $('.item_url').show('.5');
            $('.object_container').hide('.5');
            $('.title_required').html('*');
            break;
        case 'heading':
            $('.item_title').show('.5');
            $('.item_url').hide('.5');
            $('.object_container').hide('.5');
            $('.title_required').html('*');
            break;
        case '':
            $('.item_title').hide('.5');
            $('.item_url').hide('.5');
            $('.object_container').hide('.5');
            break;
        default:
            $('.title_required').html('');
            $('.item_title').show('.5');
            $(".object_title").html('<strong>' + 'انتخاب ' + $(this).find("option:selected").attr("title") + '</strong>');
            $(".object_id").select2({
                theme: "bootstrap",
                placeholder: "لطفا یک مورد را انتخاب کنید",
                minimumInputLength: 3,
                ajax: {
                    url: baseUrl + '/panel/menu-item/get/menu-objects/' + $(this).val(),
                    dataType: 'json'
                }
            });
            $('.object_container').show('.5');
            $('.item_url').hide('.5');
    }
});
