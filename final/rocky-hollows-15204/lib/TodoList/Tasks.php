<?php
/**
 * Created by PhpStorm.
 * User: patelas7
 * Date: 3/15/2016
 * Time: 11:31 AM
 */

namespace TodoList;


class Tasks extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site)
    {
        parent::__construct($site, "task");
    }

    /**
     * Get all of the tasks by day
     * @param $userId user whose tasks we are getting
     * @param $dayId number of the day (starts on Monday=1)
     * @return array of task titles
     */
    public function getTasksByDay($userId, $dayId)
    {

        $days = new Days($this->site);
        $daysTable = $days->getTableName();
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
SELECT t.id, t.title, t.priority
FROM $this->tableName t
JOIN $daysTable d
ON d.id = t.dayid
JOIN $usersTable u
ON u.id = t.userid
WHERE u.id = ? AND d.id = ?
ORDER BY FIELD(t.priority, 1, 2, 3)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($userId, $dayId));
        if ($statement->rowCount() === 0) {
            return null;
        }

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Get the task given the day
     * @param $taskId id of the task in the database
     * @return list of Task objects
     */
    public function getTaskById($taskId)
    {
        $days = new Days($this->site);
        $daysTable = $days->getTableName();
        $sql = <<<SQL
SELECT t.id, t.title, t.notes, t.priority, d.name as `day`
FROM $this->tableName t
JOIN $daysTable d
ON d.id = t.dayid
WHERE t.id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($taskId));
        if ($statement->rowCount() === 0) {
            return $taskId;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        return new Task($row);
    }

    /**
     * Add task to current user
     * @param $userId id of the user adding task
     * @param Task $task object to add
     * @return true if inserted
     */
    public function addTask($userId, Task $task)
    {
        $days = new Days($this->site);
        $dayId = $days->getDayId($task->getDay());
        $sql = <<<SQL
INSERT INTO $this->tableName(title, notes, priority, userid, dayid)
VALUES(?, ?, ?, ?, ?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($task->getTitle(), $task->getNotes(), $task->getPriority(), $userId, $dayId));
        if ($statement->rowCount() === 0) {
            return false;
        }
        return true;
    }

    /**
     * Update the task clicked on
     * @param $userId the user editing
     * @param Task $task object containing task
     * @return bool true if updated
     */
    public function updateTask($userId, Task $task)
    {

        $sql = <<<SQL
UPDATE $this->tableName
SET title=?, notes=?, priority=?
WHERE userid=? AND id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($task->getTitle(), $task->getNotes(),
            $task->getPriority(), $userId, $task->getId()));
        if ($statement->rowCount() === 0) {
            return false;
        }
        return true;

    }

    /**
     * Task to be deleted
     * @param $userId id of the user
     * @param $id id of the task
     * @return bool true if task is deleted
     */
    public function deleteTask($userId, $id)
    {
        $sql = <<<SQL
DELETE
FROM $this->tableName
where id=? and userid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            if ($statement->execute(array($id, $userId)) === false) {
                return false;
            }
        } catch (\PDOException $e) {
            // do something when the exception occurs...
            return false;
        }

        return $statement->rowCount() > 0;
    }
}