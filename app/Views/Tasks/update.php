<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Tasks</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" >ProblemBookApp</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" active href="/?route=/tasks">Tasks</a>
                <a class="nav-link" href="/?route=/tasks/create">Create task</a>
                <?php
                if (isset($_SESSION['login'])) {
                    echo '<a class="btn btn-primary" href="/?route=/auth/logout">Logout</a>';
                } else {
                    echo '<a class="btn btn-primary" href="/?route=/auth">Login</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<?php
    echo '<div class="container">';
    echo "<form action='/?route=/tasks/update&taskId=". $_GET['taskId'] . '\' ' . "method='post' style='width: 300px'>";
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