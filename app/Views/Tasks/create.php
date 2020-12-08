<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container">
        <form  action="/?route=/tasks/store" method="post" style="width: 300px">
            <h1 class="text-center">Create task</h1>
            <div class="mb-3">
                <label for="InputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="InputUsername" name="username" required>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="InputEmail" name="email" required>
            </div>
            <div class="mb-3">
                <label for="InputDescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="InputDescription" name="description">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>
</html>