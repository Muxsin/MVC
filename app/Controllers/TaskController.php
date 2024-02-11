<?php

namespace App\Controllers;
use App\Models\TaskModel;
use App\Entity\Task;

class TaskController
{
    public function index()
    {
        if (isset($_GET['order_by']) && in_array($_GET['order_by'], TaskModel::ALLOWED_ORDER_BY, true)) {
            $_SESSION['order_by'] = $_GET['order_by'];
        }
        if (isset($_GET['order_type']) && in_array($_GET['order_type'], TaskModel::ALLOWED_ORDER_TYPE, true)) {
            $_SESSION['order_type'] = $_GET['order_type'];
        }

        $model = new TaskModel();
        $model->connect();
        $tasks = $model->getAll();

        $limit = 3;
        $totalTasks = count($tasks);
        $number_of_pages = ceil($totalTasks/$limit);

        if(!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $offset = ($page - 1) * $limit;
        $tasks = $model->getByLimit($offset, $limit, $_SESSION['order_by'] ?? TaskModel::ALLOWED_ORDER_BY[0], $_SESSION['order_type'] ?? TaskModel::ALLOWED_ORDER_TYPE[0]);

        $model->disconnect();
        return [
            'view' => 'Tasks/index.php',
            'data' => [
                'tasks' => $tasks,
                'number_of_pages' => $number_of_pages,
                'page' => $page,
            ],
        ];
    }

    public function show()
    {
        $model = new TaskModel();
        $model->connect();
        $taskId = (int) $_GET['taskId'];
        $task = $model->getOne($taskId);
        $model->disconnect();

        return [
            'view' => 'Tasks/show.php',
            'data' => [
                'task' => $task,
            ],
        ];
    }

    public function create() {
        return [
            'view' => 'Tasks/create.php',
        ];
    }

    public function store() {
        if(trim($_REQUEST['username']) === "") {
            echo "Invalid username!";
            exit(0);
        } else {
            $username = htmlspecialchars(trim($_REQUEST['username']));
        }

        if(trim($_REQUEST['email']) === "") {
            echo "Invalid email!";
            exit(0);
        } else {
            $email = htmlspecialchars(trim($_REQUEST['email']));
        }

        $description = htmlspecialchars($_REQUEST['description']);
        $status = 0;
        $updated = 0;

        $model = new TaskModel();
        $model->connect();
        $task = new Task(0, $username, $email, $description, $status, $updated);
        $model->add($task);
        $model->disconnect();

        redirect('/tasks');
    }

    public function delete()
    {
        if(isset($_SESSION['login']) and $_SESSION['login'] === 1) {
            $model = new TaskModel();
            $model->connect();
            $taskId = (int)$_GET['taskId'];
            $model->delete($taskId);
            $model->disconnect();

            redirect('/tasks');
        } else {
            return [
                'view' => 'Auth/login.php',
            ];
        }

    }

    public function edit()
    {
        if(isset($_SESSION['login']) and $_SESSION['login'] === 1) {
            $model = new TaskModel();
            $model->connect();
            $taskId = (int) $_GET['taskId'];
            $task = $model->getOne($taskId);
            $model->disconnect();

            return [
                'view' => 'Tasks/update.php',
                'data' => [
                    'task' => $task,
                ],
            ];
        } else {
            return [
                'view' => 'Auth/login.php',
            ];
        }

    }

    public function update() {
        if(trim($_REQUEST['username']) === "") {
            echo "Invalid username!";
            exit(0);
        } else {
            $username = htmlspecialchars(trim($_REQUEST['username']));
        }

        if(trim($_REQUEST['email']) === "") {
            echo "Invalid email!";
            exit(0);
        } else {
            $email = htmlspecialchars(trim($_REQUEST['email']));
        }

        $description = htmlspecialchars($_REQUEST['description']);

        if(isset($_REQUEST['status'])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $updated = 1;
        $id = (int) $_GET['taskId'];
        $model = new TaskModel();
        $model->connect();
        $task = new Task($id, $username, $email, $description, $status, $updated);
        $model->update($task);
        $model->disconnect();

        redirect('/tasks/show?taskId=' . $id);
    }
}
