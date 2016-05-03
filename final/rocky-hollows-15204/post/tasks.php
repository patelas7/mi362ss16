<?php
require '../lib/todo.inc.php';

$controller = new TodoList\TaskController($site, $_SESSION, $_POST);
header("location: " . $controller->getRedirect());
