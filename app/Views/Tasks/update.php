<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Users</title>
</head>
<body>
<h1>Create user</h1>

<?php
    echo "<form action='/?route=/tasks/update&taskId=". $_GET['taskId'] . '\' ' . "method='post'>";
    echo "Username: <input type='text' name='username' value='{$task->getUsername()}'>";
    echo "Email: <input type='email' name='email' value='{$task->getEmail()}'>";
    echo "Description: <input type='text' name='description' value='{$task->getDescription()}'>";
    echo "Status: <input type='text' name='status' value='{$task->getStatus()}'>";
    ?>
    <input type="submit" value="Update">

</form>
</body>
</html>