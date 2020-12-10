<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>App</title>
</head>
<body>
<div class="container">
    <?php
    include $viewsDir . 'components/navbar.php';
    ?>

    <?php
    if (isset($successes)) {
        foreach ($successes as $success) {
            echo '<p class="col-12 alert alert-success">' . $success . '</p>';
        }
    }
    ?>

    <?php
    if (isset($infos)) {
        foreach ($infos as $info) {
            echo '<p class="col-12 alert alert-info">' . $info . '</p>';
        }
    }
    ?>

    <?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            echo '<p class="col-12 alert alert-danger">' . $error . '</p>';
        }
    }
    ?>

    <?php
    include $view;
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</div>
</body>
</html>
