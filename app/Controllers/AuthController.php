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

            addMessage('infos', 'Welcome, Admin!');

            redirect(prepareUrl('/tasks'));
        } else {
            addMessage('errors', 'Invalid username or password');
            redirect(prepareUrl('/auth'));
        }
    }
    public function logout() {
        unset($_SESSION['login']);
        session_destroy();
        session_start();

        addMessage('infos', 'Bye!');

        redirect(prepareUrl('/tasks'));
    }
}