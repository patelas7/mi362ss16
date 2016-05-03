<?php

namespace TodoList;

/**
 * Controller class for the Login page
 */
class AjaxTaskController{

    /**
     * AjaxTaskController constructor.
     * @param Site $site Site object
     * @param array $post $_POST
     * @param array $session $_SESSION
     */
    public function __construct(Site $site, $post, &$session) {
        $tasks = new Tasks($site);
        if (isset($post['getTask'])){
            $id = strip_tags($post['id']);
            $task = $tasks->getTaskById($id);
            if($task !== null){
                $this->result = json_encode(array('ok' => true,
                    'title' => $task->getTitle(), 'notes' => $task->getNotes(),
                    'priority' => $task->getPriority(), 'day' => $task->getDay()));
                return;
            }
            $this->result = json_encode(array('ok' => false,
                'message' => 'Task not found'));
        }

    }

    /**
     * Get any AJAX response
     * @return JSON result for AJAX
     */
    public function getResult() {
        return $this->result;
    }

    private $result = null;	///< Result for AJAX operations
}