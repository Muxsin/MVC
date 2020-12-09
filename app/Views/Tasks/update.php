<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Tasks</title>
</head>
<body>
    <?php include dirname(__FILE__) . '/../components/navbar.php'; ?>
<?php
    echo '<div class="container">';
    echo "<form action='" . prepareUrl('/tasks/update?taskId=' . $task->getId()) . "' method='post' style='width: 300px'>";
    echo "<h2 class='text-center'>Update user</h2>";
    echo '<div class="mb-3">';
    echo '<label for="InputUsername" class="form-label">Username</label>';
    echo "<input type='text' class='form-control' id='InputUsername' name='username' value='{$task->getUsername()}' required>";
    echo '</div>';
    echo '<div class="mb-3">';
    echo '<label for="InputEmail" class="form-label">Email address</label>';
    echo "<input type='email' class='form-control' id='InputEmail' name='email' value='{$task->getEmail()}'>";
    echo '</div>';
    echo '<div class="mb-3">';
    echo '<label for="InputDescription" class="form-label">Description</label>';
    echo "<input type='text' class='form-control' id='InputDescription' name='description' value='{$task->getDescription()}'>";
    echo '</div>';
    echo '<div class="mb-3">';
    if($task->getStatus() === 1) {
        echo "<input class='form-check-input' type='checkbox' id='statusBox' name='status' checked>";
        echo '<label class="form-check-label" for="statusBox">Status</label>';
    } else {
        echo "<input class='form-check-input' type='checkbox' id='statusBox' name='status'>";
        echo '<label class="form-check-label" for="statusBox">Status</label>';
    }
    echo '</div>';
    ?>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
</body>
</html>