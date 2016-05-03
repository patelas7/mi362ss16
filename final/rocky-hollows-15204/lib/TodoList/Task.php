<?php


namespace TodoList;


class Task
{
    /**
     * Constructor
     * @param $row Row from the user table in the database
     */
    public function __construct($row) {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->notes = $row['notes'];
        $this->priority = $row['priority'];
        $this->day = $row['day'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    private $id;
    private $title;
    private $notes;
    private $priority;
    private $day;

}
