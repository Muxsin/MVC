<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<div class="container">
    <form action="/?route=/auth" method="post" style="width: 300px">
        <h2 class="text-center">Login</h2>
        <div class="mb-3">
            <label for="InputUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="InputUsername" name="username" required>
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="InputPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>