<?php

namespace App\Models;
use \mysqli;
use App\Entity\Task;

class TaskModel {
    protected $hostname = 'localhost';
    protected $username = 'muhsin';
    protected $password = 'secret';
    protected $dbname = 'problem_book_app';

    protected $connection;

    public function __construct()
    {
        $this->connection = null;
    }

    public function connect() {
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Invalid connection: " . $this->connection->connect_error);
        }
    }

    public function getAll() {
        $sql = 'select * from tasks order by username';
        $tasks = $this->connection->query($sql)->fetch_all(MYSQLI_ASSOC);
        $result = [];

        if($tasks === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            foreach ($tasks as $task) {
                $task['description'] = ($task['description'] === NULL) ? "" : $task['description'];
                $task['status'] = (int) $task['status'];

                $result[] = new Task($task['username'], $task['email'], $task['description'], $task['status']);
            }

            return $result;
        }
    }

    public function getByLimit(int $this_page_first_result, int $result_per_page) {
        $sql = 'select * from tasks order by username limit ' . $this_page_first_result . ',' . $result_per_page;
        $tasks = $this->connection->query($sql)->fetch_all(MYSQLI_ASSOC);
        $result = [];

        if($tasks === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            foreach ($tasks as $task) {
                $task['description'] = ($task['description'] === NULL) ? "" : $task['description'];
                $task['status'] = (int) $task['status'];

                $result[] = new Task($task['username'], $task['email'], $task['description'], $task['status']);
            }

            return $result;
        }
    }

    public function getOne(int $id)
    {
        $sql = 'select * from tasks where id=' . $id;
        $task = $this->connection->query($sql)->fetch_assoc();

        if($task === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            $task['description'] = ($task['description'] === NULL) ? "" : $task['description'];
            $result = new Task($task['username'], $task['email'], $task['description'], $task['status']);

            return $result;
        }
    }

    public function add(Task $task) {
        $sql = "insert into tasks (username, email, description, status) values('{$task->getUsername()}', '{$task->getEmail()}', '{$task->getDescription()}', '{$task->getStatus()}');";
        $inserted = $this->connection->query($sql);

        if($inserted === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            return "Task was inserted successfully!";
        }
    }

    public function update(Task $task, int $id) {
        $sql = "update tasks set username='{$task->getUsername()}', email='{$task->getEmail()}', description='{$task->getDescription()}', status={$task->getStatus()} where id={$id}";
        $updated = $this->connection->query($sql);

        if($updated === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            return "Task was updated successfully!";
        }
    }

    public function delete(int $id) {
        $sql = 'delete from tasks where id=' . $id;
        $deleted = $this->connection->query($sql);

        if($deleted === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            return "Task was deleted successfully!";
        }
    }

    public function disconnect() {
        $this->connection->close();
    }

}
