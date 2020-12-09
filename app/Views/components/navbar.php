<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" >ProblemBookApp</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" active href="<?php echo prepareUrl('/tasks'); ?>">Tasks</a>
                <a class="nav-link" href="<?php echo prepareUrl('/tasks/create'); ?>">Create task</a>
                <?php
                if (isset($_SESSION['login'])) {
                    echo '<a class="btn btn-primary" href="'. prepareUrl('/auth/logout') .'">Logout</a>';
                } else {
                    echo '<a class="btn btn-primary" href="'. prepareUrl('/auth') .'">Login</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>