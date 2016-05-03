<?php
$open = true;
require 'lib/todo.inc.php';
$view = new TodoList\View();
$view->setTitle("Instructions");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="instructions">
    <?php echo $view->header(); ?>

    <h2>Getting Started</h2>
    <p>Create an account by clicking on the top right link in the header of the
    homepage. Once you have created an account, you are ready to log in! After you have logged in,
    you will be taken to your custom tasks page. This page will load all of your saved tasks.</p>

    <h2>Tasks Page</h2>

    <h3>Add task</h3>
    <p>This page has a container for every day of the week. To add a task to a day,
    click on the plus button at the top of the screen. This pops up a modal giving you the
    option of adding a title, notes, and setting a priority. Adding a title is required. Once you
    are done click the edit button to add the task or the delete button to close the modal. You can also
    close the modal by pressing the x at the top left corner of the box.</p>

    <h3>Edit task</h3>
    <p>Once you have added a task, the title will be displayed in the box of the day it was
    created for. Hovering over the title will change the color and you can click on the title to bring up the
    modal with information pre-filled with what you wrote. You can press edit after you are done to save the changes.</p>

    <h3>Delete task</h3>
    <p>On the popup modal you have the option to delete. If you are creating a new task, this button will only
    make the modal disappear. If you are editing an existing task clicking delete will popup another modal asking you to
    confirm that you want to delete the task.</p>

    <h3>Task display and colors</h3>
    <p>Each task in a given day is ordered by priority so all high priority tasks are displayed first, then
    medium priority tasks, and lastly low priority tasks. The color of the links also grow lighter as the priority
    decreases.</p>


</div>

</body>
</html>
