<!-- <?php
    session_start();
?> -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    </head>
    <body>
        <div class="row col-md-8 border rounded mx-auto mt-5 p-2 shadow-1g">
            <div class="col-md-4 text-center">
                <img src="./images/no-image.png" class="img-fluid rounded" style="width: 180px; height:180px; height:180px; object-fit: cover;">
                <div>
                    <a href="?page=edit_profile">
                        <button class="mx-auto m-1 btn-sm btn btn-primary">Edit Profile</button>
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="h1">Profile</div>
                <table class="table">
                    <tr><th colspan="2">User Details:</th></tr>
                    <tr>
                        <th>Full name</th>
                        <td><?php echo $_SESSION['name'] ?></td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <td>
                            <?php echo $_SESSION['user_id'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>
                            <?php echo $_SESSION['gender'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Phone number</th>
                        <td>
                            <?php echo $_SESSION['phone'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>
                            <?php echo $_SESSION['address'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>
                            <?php echo $_SESSION['password'] ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>