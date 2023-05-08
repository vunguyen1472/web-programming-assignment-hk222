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
                <img src="./images/anne-hathaway.jpg" class="img-fluid rounded" style="width: 180px; height:180px; height:180px; object-fit: cover;">
                <div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Click below to select the image</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="h1">Edit Profile</div>
                <table class="table">
                    <tr><th colspan="2">User Details:</th></tr>
                    <tr><th>Full name</th>
                        <td>
                            <input type="text" class="form-control" name="name" placeholder="Full name">
                        </td>
                    </tr>
                    <tr><th>ID</th>
                        <td>
                            <input type="text" class="form-control" name="id" placeholder="ID">
                        </td>
                    </tr>
                    <tr><th>Gender</th>
                        <td>
                            <select class="form-select form-select mb-3" aris-label=".form-select-lg example">
                                <option selecte value="">Select Gender</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </select>
                        </td>
                    </tr>
                    <tr><th>Phone number</th>
                        <td>
                            <input type="text" class="form-control" name="phone" placeholder="Phone number">
                        </td>
                    </tr>
                </table>

                <div class="p-2">

                </div>
            </div>
        </div>
    </body>
</html>