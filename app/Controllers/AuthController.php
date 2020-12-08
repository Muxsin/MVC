<?php

namespace App\Controllers;
use App\Controllers\TaskController;

class AuthController {

    public function loginView() {
        return [
            'view' => 'Auth/login.php',
        ];
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username === 'admin' and $password === '123') {
            $_SESSION['login'] = 1;

            return TaskController::index();
        } else {
            echo "User or password incorrect";
        }
    }
    public function logout() {
        unset($_SESSION['login']);
        session_destroy();

        return TaskController::index();
    }
}