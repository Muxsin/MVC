<nav class="navbar navbar-expand-lg navbar-light bg-light border rounded-bottom mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" >TaskMan</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?php echo prepareUrl('/tasks'); ?>">Tasks</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo prepareUrl('/tasks/create'); ?>">Create task</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ml-auto">
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo '<a class="btn btn-primary" href="'. prepareUrl('/auth/logout') .'">Logout</a>';
                    } else {
                        echo '<a class="btn btn-primary" href="'. prepareUrl('/auth') .'">Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>