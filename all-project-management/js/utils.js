$("[name='delete_project']").click(function(){
    var project_id = $(this).val();
    $.ajax({
        url: 'all-project-management/delete_project.php',
        type: 'POST',
        data: {id: project_id},
    }).done(function(result) {
        if (result == "0"){
            location.reload(true);
        }
    });
});

$("#project-update-form").on("submit", function(e){
    e.preventDefault();
    var dataString = $(this).serialize();
    $.ajax({
        url: 'all-project-management/update_project_processing.php',
        type: 'POST',
        data: dataString,
    }).done(function(result) {
        beautyToast.success({
            title: 'Success', // Set the title of beautyToast
            message: 'Update project details successfully.' // Set the message of beautyToast
        });
    });
});

$("#project-create-form").on("submit", function(e){
    e.preventDefault();
    var dataString = $(this).serialize();
    $.ajax({
        url: 'all-project-management/create_project_processing.php',
        type: 'POST',
        data: dataString,
    }).done(function(result) {
        beautyToast.success({
            title: 'Success', // Set the title of beautyToast
            message: 'Create project details successfully.' // Set the message of beautyToast
        });
        //window.location.href = "index.php?page=all_project_management";
    });
});