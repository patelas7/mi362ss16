<?php
/**
 * Created by PhpStorm.
 * User: patelas7
 * Date: 3/15/2016
 * Time: 11:31 AM
 */

namespace TodoList;


class Days extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site)
    {
        parent::__construct($site, "day");
    }

    /**
     * Get the day name by id
     * @param $id from 1-7
     * @return name of the day
     */
    public function getDayName($id){
        $sql =<<<SQL
SELECT name
FROM $this->tableName
WHERE id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        return $row['name'];
    }

    /**
     * Get the day id by name
     * @param $name of the day
     * @return id of the day
     */
    public function getDayId($name){
        $sql =<<<SQL
SELECT id
FROM $this->tableName
WHERE name = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($name));
        if($statement->rowCount() === 0) {
            return null;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        return $row['id'];
    }
}