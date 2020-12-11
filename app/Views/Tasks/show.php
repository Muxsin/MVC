<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <?php
                echo "" . $task->getUsername() . " <span class='text-muted'>(" . $task->getEmail() . ")</span>";
                ?>
            </div>
            <div class="card-body">
                <?php
                echo "<p class='m-0'>" . $task->getDescription() . "</p>";
                ?>
            </div>
            <div class="card-footer">
                <?php
                echo $task->getStatus() === 0 ? "In progress" : "Done";
                if (isset($_SESSION['login'])) {
                    echo '<div class="btn-group btn-group-sm float-right">';
                    echo '<a class="btn btn-warning" href="' . prepareUrl('/tasks/edit?taskId=' . $task->getId()) . '">Edit' . '</a>';
                    echo '<a class="btn btn-danger" href="' . prepareUrl('/tasks/delete?taskId=' . $task->getId()) . '">Delete' . '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
