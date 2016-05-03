<?php
require '../lib/todo.inc.php';

$controller = new TodoList\AjaxTaskController($site, $_POST, $_SESSION);
echo $controller->getResult();
