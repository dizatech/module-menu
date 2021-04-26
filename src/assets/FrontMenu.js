let menu_group = $('.menu_group').val();

let not_information = '<tr class="not_information"><td class="text-center" colspan="5">موردی برای نمایش وجود ندارد</td></tr>';

let front_menu_loading = `
<tr class="has_fields">
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
    load_front_menu(false);
})();

// start load menus from database
function load_front_menu(empty_table) {
    const site_menus_table = $('#site_menus_table tbody');
    if (empty_table == true){
        site_menus_table.html(front_menu_loading);
    }
    $.ajax({
        type: "post",
        url: baseUrl + '/panel/front-menu/get/menus/' + menu_group,
        dataType: 'json',
        success: function (response) {
            site_menus_table.find('.has_menus').hide(1000);
            setTimeout(function (){
                if (response.length > 0){
                    for( let i=0; i<response.length; i++ ){
                        add_menu_row( $('#site_menus_table tbody'), response[i].title, response[i].status, response[i].id );
                    }
                }else {
                    site_menus_table.append(not_information);
                }
            }, 1000);
        }
    });
}
// end load menus from database

// start add menus row after insert menus in ajax
function add_menu_row( target, menu_title, menu_status, menu_id ){
    target.append(
        "<tr class='list_row'>" +
        "<td>" + menu_id + " <input type='hidden' name='menus_id[]' value='" + menu_id + "'></td>" +
        "<td>" + menu_title + " </td>" +
        "<td>" + menu_status + "</td>" +
        "<td>" +
        "<a href='#' data-id='"+menu_id+"' class='btn btn-sm btn-success edit_menu'>ویرایش</a>" +
        "<a href='#' data-id='"+menu_id+"' class='btn btn-sm btn-danger delete_menu ml-lg-1'>حذف</a>" +
        "</td>" +
        "</tr>"
    );
}
// end add menus row after insert menus in ajax
