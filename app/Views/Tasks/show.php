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
<?php
echo "<h1>Username: {$task->getUsername()}</h1>";
echo "<h2>Email: {$task->getEmail()}</h2>";
if ($task->getDescription() === "") {
    echo "<h2>Description: Empty!</h2>";
} else {
    echo "<h2>Description: {$task->getDescription()}</h2>";
}
if ($task->getStatus() === 0) {
    echo "<h2>Status: In expectation!</h2>";
} else {
    echo "<h2>Status: Done!</h2>";
}

echo '<a href="/?route=/tasks/delete&taskId=' . $_GET['taskId'] . '">Delete' . '</a>';
?>
</body>
</html>