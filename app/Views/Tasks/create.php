<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include dirname(__FILE__) . '/../components/navbar.php'; ?>
    <div class="container">
        <form  action="<?php echo prepareUrl('/tasks/store'); ?>" method="post" style="width: 300px">
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