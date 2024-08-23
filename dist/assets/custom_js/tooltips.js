function create_tooltips() {
    var admin_url = $('#admin_url').val();
    var menu_name = $('#menu_name').val();
    var description = CKEDITOR.instances['description'].getData();

    if (menu_name == "") {
        $("#menu_name_err").fadeIn().html("Please Select Menu").css("color", "red");
        setTimeout(function () { $("#menu_name_err").fadeOut("&nbsp;"); }, 2000)

        $("#menu_name").focus();
        return false;
    }
    /*if (description == "") {
        $("#description_err").fadeIn().html("Please enter description").css('color', 'red');
        setTimeout(function () { $("#description_err").html("&nbsp;"); }, 3000);
        $("#description").focus();
        return false;
    }*/

    var form_data = new FormData();
    form_data.append('menu_name', menu_name);
    form_data.append('description', description);
    $.ajax({
        type: "post",
        url: admin_url + "Tooltips/create_action",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        data: form_data,
        success: function (returndata) {
            if (returndata == 1) {
                location.reload();
            } else {
                $("#menu_name_err").fadeIn().html("This menu_name already exits ").css("color", "red");
                setTimeout(function () { $("#menu_name_err").fadeOut("&nbsp;"); }, 2000)
                $("#menu_name").focus();
                return false;
            }
        }
    });
}

function getValue(id) {
    var admin_url = $("#admin_url").val();
    $.ajax({
        type: 'post',
        cache: false,
        url: admin_url + 'Tooltips/get_value',
        data: {id: id},
        success: function (returndata) {
            var obj = $.parseJSON(returndata);
            $("#edit_menu_name").val(obj.menu_name);
            $("#id").val(obj.id);
            CKEDITOR.instances.edit_description.setData(obj.description);
        }
    })
}

function update_tooltips() {
    var admin_url = $("#admin_url").val();
    var menu_name = $("#edit_menu_name").val().trim();
    var id = $("#id").val();
    var description = CKEDITOR.instances['edit_description'].getData();
    if (menu_name == "") {
        $("#edit_menu_name_err").fadeIn().html("Please enter menu_name").css('color', 'red');
        setTimeout(function () { $("#edit_menu_name_err").html("&nbsp;"); }, 3000);
        $("#edit_menu_name").focus();
        return false;
    }
    /*if (description == "") {
        $("#edit_description_err").fadeIn().html("Please enter description").css('color', 'red');
        setTimeout(function () { $("#edit_description_err").html("&nbsp;"); }, 3000);
        $("#edit_description").focus();
        return false;
    }*/
    var form_data = new FormData();
    form_data.append('menu_name', menu_name);
    form_data.append('description', description);
    form_data.append('id', id);
    $.ajax({
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        url: admin_url + 'Tooltips/update_action',
        data: form_data,
        success: function (returndata) {
            if (returndata == 1) {
                location.reload();
            }
            else {
                $("#edit_menu_name_err").fadeIn().html("This Menu Name already exits").css('color', 'red');
                setTimeout(function () { $("#edit_menu_name_err").html("&nbsp;"); }, 3000);
                $("#edit_menu_name").focus();
                return false;
            }
        }
    })
}

function view_data(id) {
    var admin_url = $("#admin_url").val();
    $.ajax({
        type: 'post',
        cache: false,

        url: admin_url + 'Tooltips/view',
        data: {
            id: id,
        },
        success: function (returndata) {
            var obj = $.parseJSON(returndata);
            $("#show_description").html(obj.description);
        }
    })
}