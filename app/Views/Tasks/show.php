<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Task</title>
</head>
<body>
    <?php
    if (isset($_SESSION['login'])) {
        echo '<a class="btn btn-primary stretched-link" href="/?route=/auth/logout">Logout</a>';
    }
    echo '<div class="container">';
    ?>
    <div class="card" style="width: 300px">
    <?php
    echo "<h3>Username: {$task->getUsername()}</h3>";
    echo "<p>Email: {$task->getEmail()}</p>";
    if ($task->getDescription() === "") {
        echo "<p>Description: Empty!</p>";
    } else {
        echo "<p>Description: {$task->getDescription()}</p>";
    }
    if ($task->getStatus() === 0) {
        echo "<p>Status: In expectation!</p>";
    } else {
        echo "<p>Status: Done!</p>";
    }

    echo '<a class="btn btn-danger stretched-link" href="/?route=/tasks/delete&taskId=' . $_GET['taskId'] . '">Delete' . '</a>';
    ?>
    </div>
</div>

</body>
</html>