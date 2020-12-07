<?php

namespace App\Controllers;
use App\Models\TaskModel;
use App\Entity\Task;

class TaskController
{
    public function index()
    {
        $model = new TaskModel();
        $model->connect();
        $tasks = $model->getAll();

        $result_per_page = 3;
        $number_of_results = count($tasks);
        $number_of_pages = ceil($number_of_results/$result_per_page);

        if(!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $this_page_first_result = ($page - 1) * $result_per_page;
        $tasks = $model->getByLimit($this_page_first_result, $result_per_page);

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
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $description = $_REQUEST['description'];
        $status = 0;

        $model = new TaskModel();
        $model->connect();
        $task = new Task($username, $email, $description, $status);
        $model->add($task);
        $model->disconnect();

        return $this->index();
    }

    public function delete()
    {
        $model = new TaskModel();
        $model->connect();
        $taskId = (int) $_GET['taskId'];
        $model->delete($taskId);
        $model->disconnect();

        return $this->index();
    }

    public function edit()
    {
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
    }

    public function update() {
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $description = $_REQUEST['description'];
        $status = (int) $_REQUEST['status'];

        $model = new TaskModel();
        $model->connect();
        $task = new Task($username, $email, $description, $status);
        $model->update($task, $_GET['taskId']);
        $model->disconnect();

        return $this->show();
    }

}