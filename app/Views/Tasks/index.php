<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="mb-1 row justify-content-end">
            <form class="col-lg-6" action="<?php echo prepareUrl('/tasks'); ?>" method="get">
                <div class="form-row align-items-end">
                    <div class="form-group col">
                        <label for="order_by" class="">Sort By:</label>
                        <select id="order_by" name="order_by" class="form-control">
                            <option value="username" <?php echo ($_SESSION['order_by'] ?? "username") === "username" ? "selected" : ""; ?>>Username</option>
                            <option value="email" <?php echo ($_SESSION['order_by'] ?? "username") === "email" ? "selected" : ""; ?>>Email</option>
                            <option value="status" <?php echo ($_SESSION['order_by'] ?? "username") === "status" ? "selected" : ""; ?>>Status</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="order_type" class="">Direction:</label>
                        <select id="order_type" name="order_type" class="form-control">
                            <option value="asc" <?php echo ($_SESSION['order_type'] ?? "asc") === "asc" ? "selected" : ""; ?>>a-z</option>
                            <option value="desc" <?php echo ($_SESSION['order_type'] ?? "asc") === "desc" ? "selected" : ""; ?>>z-a</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <input type="submit" class="btn btn-block btn-secondary" value="Sort">
                    </div>
                </div>
            </form>
        </div>
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
                        echo "<td>" . $task->getUsername() . "</td>";
                        echo "<td>" . $task->getEmail() . "</td>";
                        echo "<td class='text-break'>" . $task->getDescription() . "</td>";
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
