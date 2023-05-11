<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="all-project-management/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
    <body>
        <section class="panel">
            <header class="panel-heading">
                All projects List
                <span class="pull-right">
                    <button type="button" id="loading-btn" class="btn btn-warning btn-xs" onclick = location.reload()><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="?page=create_project" class=" btn btn-success btn-xs"> Create New Project</a>
                </span>
            </header>
            <br>
            <!-- <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group"><input type="text" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-success"> Go!</button> </span></div>
                    </div>
                </div>
            </div> -->
            <table class="table table-hover p-table">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Department</th>
                        <th>Project Progress</th>
                        <th>Project Status</th>
                        <th>Deadline</th>
                        <th>Custom</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                include('all-project-management/utils.php');
                $project_list = get_project_list();
                if ($project_list != NULL && $project_list->num_rows != 0){
                    while ($row = $project_list->fetch_assoc()){
                        $created_date = explode(' ', $row['created'])[0];
                        $status = $row['status'];
                        $color = 'black';
                        if ($status == "In progress"){
                            $color = 'blue';
                        }
                        else if ($status == "Done"){
                            $color = 'green';
                        }
                        $department = '';
                        if ($row['supervisor_id'] != '')
                            $department = get_department_from_id($row['supervisor_id']);
                        $progress = 0;
                        if ($row['status'] != 'Not assigned')
                            $progress = get_progress($row['id']);

                        $del_btn = '<button name="delete_project" type="button" class="btn btn-danger btn-xs" value='. $row['id'] .'><i class="fa fa-trash-o"></i> Delete </button>';

                        $progress_bar = '';
                        if ($department != ''){
                            $progress_bar = '<div class="progress progress-xs">
                                <div style="width: '. $progress .'%;" class="progress-bar progress-bar-success"></div>
                            </div>
                            <small>'. $progress .'% Complete </small>';
                            $del_btn = '';
                        }
                        if ($progress == 100){
                            $del_btn = '';
                        }
                        
                        echo '
                        <tr>
                            <td class="p-name">
                                <b>'. $row['name'] .'</b>
                                <br>
                                <small>Created '. $created_date .'</small>
                            </td>
                            <td class="p-team">
                                '.$department.'
                            </td>
                            <td class="p-progress">
                                '. $progress_bar . '
                            </td>
                            <td>
                                <span class="label label-primary"> <b style="color:'. $color .';">'. $status .'</b></span>
                            </td>
                            <td>
                                '. $row['deadline'] .'
                            </td>
                            <td>
                                <a href="?page=edit_project&project_id='. $row['id'] .'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                '. $del_btn .'
                            </td>
                        </tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </section>
        <script src="all-project-management/js/utils.js"></script>
    </body>
</html>