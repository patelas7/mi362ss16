<?php
$open = true;		// Can be accessed when not logged in
require '../lib/todo.inc.php';

$controller = new TodoList\LoginController($site, $_SESSION, $_POST);
//print_r($controller->getRedirect());
header("location: " . $controller->getRedirect());