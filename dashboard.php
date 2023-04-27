<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css\dashboard.css">
</head>

<body>
    <!-- Working version of https://dribbble.com/shots/14552329--Exploration-Task-Management-Dashboard -->
    <div class='app'>
        <main class='project'>
            <div class='project-info'>
                <h1>Homepage Design</h1>
                <div class='project-participants'>
                    <span></span>
                    <span></span>
                    <span></span>
                    <button class='project-participants__add'>Add Participant</button>

                </div>
            </div>
            <div class='project-tasks'>

                <div class='project-column'>
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>Task Ready</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
                    </div>

                    <?php include('approved.php'); ?>
                </div>
                <div class='project-column'>
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>In Progress</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
                    </div>

                    <?php include('in_progress.php'); ?>
                </div>
                <div class='project-column'>
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>Needs Review</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
                    </div>

                    <?php include('need_review.php'); ?>
                </div>
                <div class='project-column'>
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>Done</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
                    </div>

                    <?php include('done.php'); ?>

                </div>

            </div>
        </main>
        <aside class='task-details'>
            <div class='tag-progress'>
                <h2>Task Progress</h2>
                <div class='tag-progress'>
                    <p>Copywriting <span>3/8</span></p>
                    <progress class="progress progress--copyright" max="8" value="3"> 3 </progress>
                </div>
                <div class='tag-progress'>
                    <p>Illustration <span>6/10</span></p>
                    <progress class="progress progress--illustration" max="10" value="6"> 6 </progress>
                </div>
                <div class='tag-progress'>
                    <p>UI Design <span>2/7</span></p>
                    <progress class="progress progress--design" max="7" value="2"> 2 </progress>
                </div>
            </div>
            <div class='task-activity'>
                <h2>Recent Activity</h2>
                <ul>
                    <li>
                        <span class='task-icon task-icon--attachment'><i class="fas fa-paperclip"></i></span>
                        <b>Andrea </b>uploaded 3 documents
                        <time datetime="2021-11-24T20:00:00">Aug 10</time>
                    </li>
                    <li>
                        <span class='task-icon task-icon--comment'><i class="fas fa-comment"></i></span>
                        <b>Karen </b> left a comment
                        <time datetime="2021-11-24T20:00:00">Aug 10</time>
                    </li>
                    <li>
                        <span class='task-icon task-icon--edit'><i class="fas fa-pencil-alt"></i></span>
                        <b>Karen </b>uploaded 3 documents
                        <time datetime="2021-11-24T20:00:00">Aug 11</time>
                    </li>
                    <li>
                        <span class='task-icon task-icon--attachment'><i class="fas fa-paperclip"></i></span>
                        <b>Andrea </b>uploaded 3 documents
                        <time datetime="2021-11-24T20:00:00">Aug 11</time>
                    </li>
                    <li>
                        <span class='task-icon task-icon--comment'><i class="fas fa-comment"></i></span>
                        <b>Karen </b> left a comment
                        <time datetime="2021-11-24T20:00:00">Aug 12</time>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {

        var dragSrcEl = null;
        var innerp = null;
        var innerText = null;

        function handleDragStart(e) {
            this.style.opacity = '0.1';
            this.style.border = '3px dashed #c4cad3';

            dragSrcEl = this;

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);

            var pElement = this.querySelector('p');
            innerp = pElement.innerHTML; // Update the global innerp variable
            // Get the inner text of the <p> element
            // Set the value of $row['status'] to innerText

        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }

            e.dataTransfer.dropEffect = 'move';

            return false;
        }

        function handleDragEnter(e) {
            this.classList.add('task-hover');
        }

        function handleDragLeave(e) {
            this.classList.remove('task-hover');
        }

        function handleDrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation(); // stops the browser from redirecting.
            }

            if (dragSrcEl != this) {
                // Get the inner text of the <h6> element
                var h6Element = this.querySelector('h6'); // Get the <h6> element within the dragged task
                innerText = h6Element.innerText; // Get the inner text of the <h6> element



                this.parentNode.append(dragSrcEl)

                // Send an AJAX request to update the status of the task in the database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_status.php", true); // Assuming the PHP script to update status is named "update_status.php"
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Update successful
                            console.log("Status updated successfully.");
                            console.log(innerp);
                            console.log(innerText);
                        } else {
                            // Update failed
                            console.error("Error updating status: " + xhr.statusText);
                        }
                    }
                };
                xhr.send("innerp=" + encodeURIComponent(innerp) + "&innerText=" + encodeURIComponent(innerText));
            }

            return false;
        }

        function handleDragEnd(e) {
            this.style.opacity = '1';
            this.style.border = '0';

            items.forEach(function(item) {
                item.classList.remove('task-hover');
            });
            location.reload();

        }

        let items = document.querySelectorAll('.task');
        items.forEach(function(item) {

            item.addEventListener('dragstart', handleDragStart, false);
            item.addEventListener('dragenter', handleDragEnter, false);
            item.addEventListener('dragover', handleDragOver, false);
            item.addEventListener('dragleave', handleDragLeave, false);
            item.addEventListener('drop', handleDrop, false);
            item.addEventListener('dragend', handleDragEnd, false);
        });

    });
</script>


</html>