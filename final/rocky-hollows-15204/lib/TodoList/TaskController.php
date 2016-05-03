<?php

namespace TodoList;

class TaskController{
    public function __construct(Site $site,  &$session, $post){

        $tasks = new Tasks($site);
        $user = $session[User::SESSION_NAME];
        $root = $site->getRoot();
        if(isset($post['add'])) {
            $day = strip_tags($post['day']);
            $title = strip_tags($post['title']);
            $notes = strip_tags($post['notes']);
            $notes = ($notes === null) ? '' : $notes;
            $priority = strip_tags($post['priority']);
            $row = array("id"=>0, "day"=>$day, "title"=>$title, "notes"=>$notes,
                "priority"=>$priority);

            $task = new Task($row);
            $tasks->addTask($user->getId(), $task);

            $this->redirect = "/tasks.php";
            return;
        }
        if(isset($post['edit'])){
            $id = strip_tags($post['id']);
            $day = strip_tags($post['day']);
            $title = strip_tags($post['title']);
            $notes = strip_tags($post['notes']);
            $notes = ($notes === null) ? '' : $notes;
            $priority = strip_tags($post['priority']);
            $row = array("id"=>$id, "day"=>$day, "title"=>$title, "notes"=>$notes,
                "priority"=>$priority);

            $task = new Task($row);
            $tasks->updateTask($user->getId(), $task);

            $this->redirect = "/tasks.php";
            return;
        }
        if(isset($post['delete'])){
            $id = strip_tags($post['id']);
            $tasks->deleteTask($user->getId(), $id);
            $this->redirect = "/tasks.php";
            return;
        }

    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }


    private $redirect;

}