<?php
require '../lib/todo.inc.php';
if(isset($_SESSION[TodoList\User::SESSION_NAME])) {
    unset($_SESSION[TodoList\User::SESSION_NAME]);
    $root = $site->getRoot();
    header("location: /");
}