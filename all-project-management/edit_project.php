<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="all-project-management/css/edit_project.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link href="https://rawcdn.githack.com/ferdinalaxewall/beautyToast/v1.0.0b/beautyToast.min.css" rel="stylesheet" />
	</head>
    <body>
        <div class="formbold-main-wrapper">
            <div class="formbold-form-wrapper">
                <div>
                    <h1 style="text-align:center; font-size:30px;">Project Details</h1>
                </div>
                <br>
                <br>
                <form action="" id="project-update-form">
                    <?php
                        include('all-project-management/utils.php');
                        $project_info = get_project_info($_GET["project_id"]);
                        $selection = '';
                        if ($project_info['supervisor_id'] == ''){
                            $selection .= '<option value="-1" selected>None</option>';
                        }
                        $department_list = get_department_list();
                        while($department = $department_list->fetch_assoc()){
                            $selection .= '<option value='.$department["supervisor_id"];
                            if ($department["supervisor_id"] == $project_info['supervisor_id']){
                                $selection .= ' selected';
                            }
                            $selection .= '>'.$department["name"].'</option>';
                        }
                        
                        echo '
                        <div class="formbole-input-flex">
                            <input type="hidden" name="project_id" value='.$_GET["project_id"].'>
                            <input type="hidden" name="status" value="'.$project_info["status"].'">
                            <label for="projectname" class="formbold-form-label"> Project Name </label>
                            <input
                                type="text"
                                name="projectname"
                                id="projectname"
                                placeholder="Project '.$_GET["project_id"].'"
                                class="formbold-form-input"
                                value="'. $project_info["name"] .'"
                            />
                        </div>
                        <br>
                        <div>
                            <label class="formbold-form-label">Assign to</label>

                            <select class="formbold-form-input" name="assignto" id="assignto">
                            '.$selection.'
                            </select>
                        </div>
                        <br>
                        <div class="formbold-mb-3">
                            <label for="deadline" class="formbold-form-label"> Deadline </label>
                            <input type="datetime-local" name="deadline" id="deadline" class="formbold-form-input" value="'.substr($project_info["deadline"], 0, 16).'"/>
                            
                        </div>
                        <br>
                        <div class="formbold-mb-3">
                            <label for="message" class="formbold-form-label">
                            Description
                            </label>
                            <textarea
                            rows="6"
                            name="message"
                            id="message"
                            class="formbold-form-input"
                            >'.$project_info["description"].'</textarea>
                        </div>
                        <button type="submit" class="formbold-btn">Save</button>';
                    ?>
                </form>
            </div>
        </div>
        
        <script src="all-project-management/js/utils.js"></script>
        <script src="https://rawcdn.githack.com/ferdinalaxewall/beautyToast/v1.0.0b/beautyToast.min.js"></script>
    </body>
</html>