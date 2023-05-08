function enable_btn(obj){
    var id = obj.getAttribute("id");
    arr = id.split("_");

    var btn_id = 'role_change_btn_' + arr[0];
    var inp_id = 'role_change_' + arr[0];
    var old_role = arr[1];
    var new_role = obj.options[obj.selectedIndex].value;
    const btn = document.getElementById(btn_id);
    const inp = document.getElementById (inp_id)
    if (old_role != new_role){
        btn.removeAttribute('disabled');
        inp.setAttribute('value', new_role);
        btn.setAttribute('class', "btn btn-info");
    }
    else {
        btn.setAttribute('disabled', '');
        btn.setAttribute('class', "btn btn-default");
        inp.setAttribute('value', old_role);
    }
}

$( "#role_update_form" ).on( "submit", function(e) {
    e.preventDefault();
    var dataString = $(this).serialize();
    $.ajax({
        url: 'role-management/update_role_process.php',
        type: 'POST',
        data: dataString,
    }).done(function(result) {
        // $("#result").html(result);
        if (result.length > 1){
            let arr_elements = result.split("_");
            var btn_id = 'role_change_btn_' + arr_elements[0];
            var inp_id = 'role_change_' + arr_elements[0];
            var select_id = arr_elements[0] + "_" + arr_elements[1];
            const selectItem = document.getElementById(select_id);
            const btn = document.getElementById(btn_id);
            const inp = document.getElementById (inp_id);

            selectItem.setAttribute('id', arr_elements[0] + "_" + arr_elements[2]);
            btn.setAttribute('disabled', '');
            btn.setAttribute('class', "btn btn-default");
            inp.setAttribute('value', arr_elements[2]);

            beautyToast.success({
                title: 'Success', // Set the title of beautyToast
                message: 'Change role successfully.' // Set the message of beautyToast
            });
        }
    });
    
});