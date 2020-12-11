<?php

namespace App\Models;
use \mysqli;
use App\Entity\Task;

class TaskModel {
    const ALLOWED_ORDER_BY = ['username', 'email', 'status'];
    const ALLOWED_ORDER_TYPE = ['asc', 'desc'];

    protected $hostname;
    protected $username;
    protected $password;
    protected $dbname;

    /**
     * @var mysqli|null
     */
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
                $task['updated'] = (int) $task['updated'];

                $result[] = new Task($task['id'], $task['username'], $task['email'], $task['description'], $task['status'], $task['updated']);
            }

            return $result;
        }
    }

    public function getByLimit(int $offset, int $limit, string $orderBy = 'username', string $orderType = 'ASC')
    {
        $orderType = strtolower($orderType);
        if (!in_array($orderBy, self::ALLOWED_ORDER_BY, true)) {
            $orderBy = self::ALLOWED_ORDER_BY[0];
        }
        if (!in_array($orderType, self::ALLOWED_ORDER_TYPE, true)) {
            $orderType = self::ALLOWED_ORDER_TYPE[0];
        }
        $sql = $this->connection->prepare("select * from tasks order by $orderBy $orderType limit ? offset ?");
        $sql->bind_param('ii', $limit, $offset);
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
                $task['updated'] = (int) $task['updated'];

                $result[] = new Task($task['id'], $task['username'], $task['email'], $task['description'], $task['status'], $task['updated']);
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
            $result = new Task($task['id'], $task['username'], $task['email'], $task['description'], $task['status'], $task['updated']);

            return $result;
        }
    }

    public function add(Task $task) 
    {
        $statement = $this->connection->prepare("insert into tasks (username, email, description, status, updated) values (?, ?, ?, ?, ?)");
        if ($statement !== false) {
            $result = $statement->bind_param("sssii", $username, $email, $description, $status, $updated);

            if ($result !== false) {
                $username = $task->getUsername();
                $email = $task->getEmail();
                $description = $task->getDescription();
                $status = $task->getStatus();
                $updated = $task->getUpdated();

                $result = $statement->execute();

                if ($result !== false) {
                    $statement->close();

                    addMessage('successes', 'Task was created successfully.');

                    return true;
                }
            }
        } else {
            addMessage('errors', $this->connection->error);

            return false;
        }

        addMessage('errors', $statement->error);

        return false;
    }

    public function update(Task $task) {
        $statement = $this->connection->prepare("update tasks set username=?, email=?, description=?, status=?, updated=? where id=?");
        if ($statement !== false) {
            $result = $statement->bind_param("sssiii", $username, $email, $description, $status, $updated, $id);

            if ($result !== false) {
                $username = $task->getUsername();
                $email = $task->getEmail();
                $description = $task->getDescription();
                $status = $task->getStatus();
                $updated = $task->getUpdated();
                $id = $task->getId();

                $result = $statement->execute();

                if ($result !== false) {
                    $statement->close();

                    addMessage('infos', 'Task was updated successfully.');

                    return true;
                }
            }
        } else {
            addMessage('errors', $this->connection->error);

            return false;
        }

        addMessage('errors', $statement->error);

        return false;
    }

    public function delete(int $id) {
        $statement = $this->connection->prepare('delete from tasks where id=?');

        if ($statement !== false) {
            $result = $statement->bind_param('i', $id);

            if ($result !== false) {
                $result = $statement->execute();

                if($result !== false) {
                    $statement->close();

                    addMessage('infos', 'Task was deleted successfully.');

                    return true;
                }
            }
        } else {
            addMessage('errors', $this->connection->error);

            return false;
        }

        addMessage('errors', $statement->error);

        return false;
    }

    public function disconnect() {
        $this->connection->close();
    }

}
