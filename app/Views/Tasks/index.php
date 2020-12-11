<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="mb-1 row justify-content-end">
            <form class="col-lg-6" action="<?php echo prepareUrl('/tasks'); ?>" method="get">
                <div class="form-row align-items-end">
                    <div class="form-group col  ">
                        <label for="order_by" class="">Сортировать по:</label>
                        <select id="order_by" name="order_by" class="form-control">
                            <option value="username" <?php echo ($_SESSION['order_by'] ?? "username") === "username" ? "selected" : ""; ?>>Имя пользователя</option>
                            <option value="email" <?php echo ($_SESSION['order_by'] ?? "username") === "email" ? "selected" : ""; ?>>Эл. почта</option>
                            <option value="status" <?php echo ($_SESSION['order_by'] ?? "username") === "status" ? "selected" : ""; ?>>Статус</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="order_type" class="">Направления:</label>
                        <select id="order_type" name="order_type" class="form-control">
                            <option value="asc" <?php echo ($_SESSION['order_type'] ?? "asc") === "asc" ? "selected" : ""; ?>>а-я</option>
                            <option value="desc" <?php echo ($_SESSION['order_type'] ?? "asc") === "desc" ? "selected" : ""; ?>>я-а</option>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <input type="submit" class="btn btn-block btn-secondary" value="Сортировать">
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover m-0">
                    <thead class="thead-light w-100">
                    <tr class="w-100">
                        <th>Имя пользователя</th>
                        <th>Эл. почта</th>
                        <th>Текст задачи</th>
                        <th>Статус</th>
                        <th>Настройка</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($tasks as $task) {
                        echo "<tr>";
                        echo "<td>" . $task->getUsername() . "</td>";
                        echo "<td>" . $task->getEmail() . "</td>";
                        echo "<td class='text-break'>" . $task->getDescription() . "</td>";
                        if ($task->getStatus() === 0) {
                            if ($task->getUpdated() === 1) {
                                echo "<td class='text-break'>В ходе выполнения. Отредактировано администратором.</td>";
                            } else {
                                echo "<td>В ходе выполнения</td>";
                            }
                        } else {
                            if ($task->getUpdated() === 1) {
                                echo "<td class='text-break'>Выполнено. Отредактировано администратором.</td>";
                            } else {
                                echo "<td>Выполнено</td>";
                            }
                        }
                        echo "<td><div class='btn-group'>";
                        echo "<a class='btn btn-sm btn-primary' href='" . prepareUrl('/tasks/show?taskId=' . $task->getId()) . "'>Показать</a>";
                        echo "<a class='btn btn-sm btn-warning' href='" . prepareUrl('/tasks/edit?taskId=' . $task->getId()) . "'>Редактировать</a>";
                        echo "<a class='btn btn-sm btn-danger' href='" . prepareUrl('/tasks/delete?taskId=' . $task->getId()) . "'>Удалить</a>";
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
