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
                    echo '<a class="btn btn-warning" href="' . '/tasks/edit?taskId=' . $task->getId() . '">Редактировать' . '</a>';
                    echo '<a class="btn btn-danger" href="' . '/tasks/delete?taskId=' . $task->getId() . '">Удалить' . '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
