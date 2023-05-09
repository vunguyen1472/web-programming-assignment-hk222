<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    </head>
    <body>
        <div class="row col-md-8 border rounded mx-auto mt-5 p-2 shadow-1g">
            <div class="col-md-4 text-center">
                <img src="./images/no-image.png" class="img-fluid rounded" style="width: 180px; height:180px; height:180px; object-fit: cover;">
                <!-- <div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Click below to select the image</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
            </div>
            <div class="col-md-8">
                <div class="h1">Edit Profile</div>
                <form method="post">
                    <table class="table table-striped">
                        <tr><th colspan="2">User Details:</th></tr>
                        <tr><th>Full name</th>
                            <td>
                                <input value="<?=$_SESSION['name']?>" type="text" class="form-control" name="name" placeholder="Full name">
                            </td>
                        </tr>
                        <tr><th>ID</th>
                            <td>
                                <input value="<?=$_SESSION['user_id']?>" type="text" class="form-control" name="id" placeholder="ID">
                            </td>
                        </tr>
                        <tr><th>Gender</th>
                            <td>
                                <select class="form-select form-select mb-3" aris-label=".form-select-lg example">
                                    <option value="">Select Gender</option>
                                    <option selected value="<?=$_SESSION['gender']?>"><?=$_SESSION['gender']?></option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </td>
                        </tr>
                        <tr><th>Phone number</th>
                            <td>
                                <input value="<?=$_SESSION['phone']?>" type="text" class="form-control" name="phone" placeholder="Phone number">
                            </td>
                        </tr>
                        <tr><th>Address</th>
                            <td>
                                <input value="<?=$_SESSION['address']?>" type="text" class="form-control" name="address" placeholder="Address">
                            </td>
                        </tr>
                    
                    </table>

                    <div class="p-2">
                        <button class="btn btn-primary float-end">Save</button>
                        <a href="profile.php">
                            <label class="btn btn-secondary">Back</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
