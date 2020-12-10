<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover m-0">
                    <thead class="thead-light w-100">
                    <tr class="w-100">
                        <th>Username</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($tasks as $task) {
                        echo "<tr>";
                        echo "<td>{$task->getUsername()}</td>";
                        echo "<td>{$task->getEmail()}</td>";
                        echo "<td class='text-break'>{$task->getDescription()}</td>";
                        if ($task->getStatus() === 0) {
                            echo "<td>In progress</td>";
                        } else {
                            echo "<td>Done</td>";
                        }
                        echo "<td><div class='btn-group'>";
                        echo "<a class='btn btn-sm btn-primary' href='" . prepareUrl('/tasks/show?taskId=' . $task->getId()) . "'>Show</a>";
                        echo "<a class='btn btn-sm btn-warning' href='" . prepareUrl('/tasks/edit?taskId=' . $task->getId()) . "'>Edit</a>";
                        echo "<a class='btn btn-sm btn-danger' href='" . prepareUrl('/tasks/delete?taskId=' . $task->getId()) . "'>Delete</a>";
                        echo "</div></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 text-center pt-4">
        <div class="btn-group">
            <?php
            for($page = 1; $page <= $number_of_pages; $page++) {
                echo '<a class="btn btn-light border" href="' . prepareUrl('/tasks?page=' . $page) . '">' . $page. ' ' . '</a>';
            }
            ?>
        </div>
    </div>
</div>
