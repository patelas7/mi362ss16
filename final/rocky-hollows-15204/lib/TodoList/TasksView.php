<?php
/**
 * Created by PhpStorm.
 * User: patelas7
 * Date: 4/25/2016
 * Time: 1:00 PM
 */

namespace TodoList;

class TasksView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     * @param $session $_SESSION variable
     */
    public function __construct(Site $site, array $session) {
        $name = $session[User::SESSION_NAME]->getName();
        $title = $name . "'s To-Do List";
        $this->setTitle($title);
        $this->session = $session;
        $this->site = $site;
    }

    public function head(){
        $html = parent::head();
        $html .= <<<HTML
<script src="jslib/Tasks.js"></script>
<script>
$(document).ready(function() {
   new Tasks();
});
</script>
HTML;
        return $html;

    }




    public function present(){
        $html = '<form class="tasksForm">';
        $tasks = new Tasks($this->site);
        $days = new Days($this->site);
        $userId = $this->session[User::SESSION_NAME]->getId();
        for($i=1; $i<=7; $i++){
            $day = $days->getDayName($i);
            $html .= '<div class="day"><a href=""><img src="images/plus.png" alt="Add button"></a>
			<h2>'. $day .'</h2><p class="message">&nbsp;</p>';

            $taskList = $tasks->getTasksByDay($userId, $i);
            if($taskList !== null){
                $html .= '<div class="day-tasks"><ul class="day-list">';
                foreach($taskList as $taskItem){
                    $html .= '<li><a href="">'. $taskItem['title'] .'</a><input type="hidden" name="taskId" value="'.
                        $taskItem['id'].'"/><input type="hidden" name="taskPriority" value="'.
                        $taskItem['priority'].'"/></li>';
                }
                $html .= '</ul></div>';
            }
            $html .= '</div>';
        }
        $html .= '<div class="clear"></div></form>';

        return $html;

    }

    public function presentOverlay(){
        $html = <<<HTML
	<div class = "add-task">
		<form class="addForm" method="post" action="post/tasks.php">
			<a href="">X</a>
			<input type = "text" id = "title" name="title" placeholder= "Title">
            <p class="message"></p>
			<textarea class="notes" name="notes" placeholder="Notes..."></textarea>
			<p class="p-priority">
				<label for="priority">Priority: </label>
				<select id="priority" name="priority">
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>
			</p>
			<input type = "button" id = "delete" name="delete" value = "Delete">
			<input type = "button" id = "edit" name="edit" value = "Edit">
		</form>
	</div>
HTML;
        return $html;
    }

    private $session;
    private $site;

}
