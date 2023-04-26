<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css\tasks-management.css">
</head>
<body>
<h4>Tasks management</h4>

<div class="border p-4 mt-4 shadow">
    <h6 class="mb-4 ">Your tasks</h6>

    <table class="table table-hover">
        <thead>
            <tr class="d-flex">
                <th class="col-5 py-3">Activity</th>
                <th class="col-3 py-3">Deadline</th>
                <th class="col-3 py-3">Assigned by</th>
                <th class="col-1 py-3">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr class="d-flex">
                <td class="col-5 py-3">Activity name 1</td>
                <td class="col-3 py-3">dd/mm/yyyy</td>
                <td class="col-3 py-3">Supervisor 1</td>
                <td class="col-1 py-3 text-primary fw-bold">In progress</td>
            </tr>
            <tr class="d-flex">
                <td class="col-5 py-3">Activity name 2</td>
                <td class="col-3 py-3">dd/mm/yyyy</td>
                <td class="col-3 py-3">Supervisor 2</td>
                <td class="col-1 py-3 text-warning fw-bold">Waiting</td>
            </tr>
            <tr class="d-flex">
                <td class="col-5 py-3">Activity name 3</td>
                <td class="col-3 py-3">dd/mm/yyyy</td>
                <td class="col-3 py-3">Supervisor 3</td>
                <td class="col-1 py-3 text-success fw-bold">Approved</td>
            </tr>
            <tr class="d-flex">
                <td class="col-5 py-3">Activity name 3</td>
                <td class="col-3 py-3">dd/mm/yyyy</td>
                <td class="col-3 py-3">Supervisor 4</td>
                <td class="col-1 py-3 text-danger fw-bold">Rejected</td>
            </tr>
        </tbody>
    </table>
</div>
</body>

<script>
    var rows = document.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        rows[i].onclick = function() {
            var newUrl = "homepage.php?page=task-management";
            window.location.href = newUrl;
        };
    }
</script>
</html>