<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tasks</title>
</head>
<body>
    <?php include dirname(__FILE__) . '/../components/navbar.php'; ?>
<?php
if(isset($_SESSION['msg'])) {
   echo "<p>{$_SESSION['msg']}</p>";
   unset($_SESSION['msg']);
}
?>
<table class="table">
    <h1 class="text-center">Tasks</h1>
    <thead class="thead-ligh">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Description</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <?php
    foreach ($tasks as $task) {
        echo "<tr>";
//        echo '<a href="/?route=/tasks&page=' . $ . '">' . $page . '</a>';
        echo "<td>{$task->getUsername()}</td>";
        echo "<td>{$task->getEmail()}</td>";
        if ($task->getDescription() === "") {
            echo "<td>Empty</td>";
        } else {
            echo "<td>{$task->getDescription()}</td>";
        }
        if ($task->getStatus() === 0) {
            echo "<td>In expectation!</td>";
        } else {
            echo "<td>Done!</td>";
        }
        echo "<td><a class='btn btn-primary' href='" . prepareUrl('/tasks/show?taskId=' . $task->getId()) . "'>Show</a> | <a class='btn btn-primary' href='" . prepareUrl('/tasks/edit?taskId=' . $task->getId()) . "'>Edit</a></td>";
        echo "</tr>";
    }
    ?>
</table>
<?php
for($page = 1; $page <= $number_of_pages; $page++) {
    echo '<a href="' . prepareUrl('/tasks?page=' . $page) . '">' . $page. ' ' . '</a>';
}
?>
</body>
</html>