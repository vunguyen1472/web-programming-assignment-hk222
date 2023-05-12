<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="role-management/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link href="https://rawcdn.githack.com/ferdinalaxewall/beautyToast/v1.0.0b/beautyToast.min.css" rel="stylesheet" />
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Company Role Management</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>No.</th>
						      <th>Name</th>
                              <th>ID</th>
						      <th>Department</th>
						      <th>Role</th>
                              <th></th>
						    </tr>
						  </thead>
						  <tbody>
                            <?php 
                                include("role-management/lib.php");

                                $servername = "localhost";
                                $username = "root";
                                $password = NULL;
                                $dbname = "enterprise_management";


                                $conn = new mysqli($servername, $username, $password, $dbname);
                                
    
                                $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 5;
                                $page       = ( isset( $_GET['numpage'] ) ) ? $_GET['numpage'] : 1;
                                $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
                                $query = "SELECT `id`, `name`, `type` FROM `user` WHERE 1 ";
                            
                                $Paginator  = new Paginator( $conn, $query );
                            
                                $results    = $Paginator->getData( $limit, $page );
                                $role_name = ["supervisor" => "Supervisor", "staff" => "Staff"];
                                for( $i = 0; $i < count( $results->data ); $i++ ) : 
                                    $row = $results->data[$i];

                                    if ($row["type"] != "director"){
                                        echo '
                                        <tr>
                                            <th scope="row">'. ($i + 1) .'</th>
                                            <td>' . $row["name"] . '</td>
                                            <td>' . $row["id"] . '</td>
                                            <td> UPDATING </td>
                                            <td>
                                            <select id=' . $row["id"] . '_' . $row["type"] . ' onChange="enable_btn(this)">';
                                            foreach ($role_name as $key => $value){
                                                if ($key == $row["type"]){
                                                    echo '<option value=' . $row["type"] . ' selected>' . $value . '</option>';
                                                }
                                                else{
                                                    echo '<option value=' . $key . '>' . $value . '</option>';
                                                }
                                            }
                                            echo '
                                            </td>
                                            <td>
                                            
                                            <form action="" id="role_update_form">
                                                <button type="submit" class="btn btn-default" id="role_change_btn_' . $row["id"] . '" disabled>Change</button>
                                                <input type="hidden" name="id" value='. $row["id"] .'>
                                                <input type="hidden" id="role_change_' . $row["id"] . '" name="role" value='. $row["type"] .'>
                                            </form>
                                            
                                        </tr>';
                                    }
                                endfor;
                                /* 
                                $staff_list = get_staff_info_list();
                                if ($staff_list->num_rows != 0){
                                    $idx = 0;
                                    while ($row = $staff_list->fetch_assoc()){
                                        if ($row["type"] != "director"){
                                            $idx = $idx + 1;
                                            echo '
                                            <tr>
                                                <th scope="row">'.$idx.'</th>
                                                <td>' . $row["name"] . '</td>
                                                <td>' . $row["id"] . '</td>
                                                <td> UPDATING </td>
                                                <td>
                                                <select id=' . $row["id"] . '_' . $row["type"] . ' onChange="enable_btn(this)">';
                                                foreach ($role_name as $key => $value){
                                                    if ($key == $row["type"]){
                                                        echo '<option value=' . $row["type"] . ' selected>' . $value . '</option>';
                                                    }
                                                    else{
                                                        echo '<option value=' . $key . '>' . $value . '</option>';
                                                    }
                                                }
                                                echo '</td>
                                                <td>
                                                
                                                <form action="" id="role_update_form">
                                                    <button type="submit" class="btn btn-default" id="role_change_btn_' . $row["id"] . '" disabled>Change</button>
                                                    <input type="hidden" name="id" value='. $row["id"] .'>
                                                    <input type="hidden" id="role_change_' . $row["id"] . '" name="role" value='. $row["type"] .'>
                                                </form>
                                                
                                            </tr>';
                                        }
                                    }
                                } */
                            ?>

						  </tbody>
						</table>
					</div>
				</div>
			</div>
            <?php
            echo $Paginator->createLinks( $links );
            ?>
		</div>
	</section>
    <script src="role-management/js/utils.js"></script>
    <script src="role-management/js/jquery.min.js"></script>
    <script src="role-management/js/popper.js"></script>
    <script src="role-management/js/bootstrap.min.js"></script>
    <script src="role-management/js/main.js"></script>
    <script src="https://rawcdn.githack.com/ferdinalaxewall/beautyToast/v1.0.0b/beautyToast.min.js"></script>

	</body>
</html>

