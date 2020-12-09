<?php

namespace App\Models;
use \mysqli;
use App\Entity\Task;

class TaskModel {
    protected $hostname;
    protected $username;
    protected $password;
    protected $dbname;

    protected $connection;

    public function __construct()
    {
        global $config;

        $this->hostname = $config['mysql']['hostname'];
        $this->username = $config['mysql']['username'];
        $this->password = $config['mysql']['password'];
        $this->dbname = $config['mysql']['database'];

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

                $result[] = new Task($task['id'], $task['username'], $task['email'], $task['description'], $task['status']);
            }

            return $result;
        }
    }

    public function getByLimit(int $this_page_first_result, int $result_per_page)
    {
        $sql = $this->connection->prepare('select * from tasks order by username limit ?, ?');
        $sql->bind_param('ii', $this_page_first_result, $result_per_page);
        $sql->execute();
        $tasks = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        $sql->close();
        $result = [];

        if($tasks === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            foreach ($tasks as $task) {
                $task['description'] = ($task['description'] === NULL) ? "" : $task['description'];
                $task['status'] = (int) $task['status'];

                $result[] = new Task($task['id'], $task['username'], $task['email'], $task['description'], $task['status']);
            }

            return $result;
        }
    }

    public function getOne(int $id)
    {
        $sql = $this->connection->prepare('select * from tasks where id=?');
        $sql->bind_param("i", $id);
        $sql->execute();
        $task = $sql->get_result()->fetch_assoc();
        $sql->close();

        if($task === NULL) {
            return "Error: " . $sql . "<br>" . $this->connection->error;
        } else {
            $task['description'] = ($task['description'] === NULL) ? "" : $task['description'];
            $result = new Task($task['id'], $task['username'], $task['email'], $task['description'], $task['status']);

            return $result;
        }
    }

    public function add(Task $task) 
    {
        $sql = $this->connection->prepare("insert into tasks (username, email, description, status) values (?, ?, ?, ?)");
        $sql->bind_param("sssi", $username, $email, $description, $status);

        $username = $task->getUsername();
        $email = $task->getEmail();
        $description = $task->getDescription();
        $status = $task->getStatus();
        $sql->execute();
        $sql->close();

        $_SESSION['msg'] = "Task was created successfully";
    }

    public function update(Task $task) {
        $sql = $this->connection->prepare("update tasks set username=?, email=?, description=?, status=? where id=?");
        $sql->bind_param("sssii", $username, $email, $description, $status, $id);
        $username = $task->getUsername();
        $email = $task->getEmail();
        $description = $task->getDescription();
        $status = $task->getStatus();
        $id = $task->getId();
        $sql->execute();
        $sql->close();

        $_SESSION['msg'] = "Task was updated successfully";
    }

    public function delete(int $id) {
        $sql = $this->connection->prepare('delete from tasks where id=?');
        $sql->bind_param('i', $id);
        $sql->execute();
        $sql->close();

        $_SESSION['msg'] = "Task was deleted successfully";
    }

    public function disconnect() {
        $this->connection->close();
    }

}
