<?php
    include("task-assignment\utils.php");
?>

<?php
    Utils::getTaskInfo($_GET["task-id"]);
?>

<ul class="submission-list d-flex flex-wrap border-bottom px-0 mb-0">
    <?php
        // $submissions = Utils::getTaskSubmissions($_GET["task-id"]);
        // while ($submission = $submissions->fetch_assoc()){
        //     echo "<li class='submission d-flex m-4'>";
        //         echo "<i class='fa-regular fa-file me-4'></i>";
        //         echo "<div>";
        //             <h6>Submission1.doc</h6>
        //             <span>14 Jul, 2002</span>
        //         echo "</div>";
        //     echo "</li>";
        // }
    ?>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>
                <a href="">Submission1.doc</a>
            </h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4">
        <i class="fa-regular fa-file me-4"></i>
        <div>
            <h6>Submission1.doc</h6>
            <span>14 Jul, 2002</span>
        </div>
    </li>
    <li class="submission d-flex m-4 align-items-center">
        <i class="fa-regular fa-file me-4"></i>
        <a href="">Add more submission</a>
    </li>
        
</ul>
<div class="py-4" style="min-height: 10rem">
    <h5>Comments</h5>
</div>