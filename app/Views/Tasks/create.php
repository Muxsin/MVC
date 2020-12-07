<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Users</title>
</head>
<body>
    <h1>Create user</h1>
    <form action="/?route=/tasks/store" method="post">
        Username: <input type="text" name="username">
        Email: <input type="email" name="email">
        Description <input type="text" name="description">
        <input type="submit" value="Create">

    </form>
</body>
</html>