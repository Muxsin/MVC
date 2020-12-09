<?php

namespace App\Controllers;
use App\Controllers\TaskController;

class AuthController {

    private $adminUsername;
    private $adminPassword;

    public function __construct()
    {
        global $config;

        $this->adminUsername = $config['admin']['username'];
        $this->adminPassword = $config['admin']['password'];
    }

    public function loginView() {
        return [
            'view' => 'Auth/login.php',
        ];
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username === $this->adminUsername and $password === $this->adminPassword) {
            $_SESSION['login'] = 1;

            redirect(prepareUrl('/tasks'));
        } else {
            echo "Invalid username or password!";
        }
    }
    public function logout() {
        unset($_SESSION['login']);
        session_destroy();

        redirect(prepareUrl('/tasks'));
    }
}