<?php
/**
 * @file
 * A file loaded for all pages on the site.
 */
require __DIR__ . "/../vendor/autoload.php";

$site = new TodoList\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}

// Start the session system
session_start();

$user = null;
if(isset($_SESSION[TodoList\User::SESSION_NAME])){
    $user = $_SESSION[TodoList\User::SESSION_NAME];
}

// redirect if user is not logged in
if(!isset($open) && $user === null) {
    $root = $site->getRoot();
    header("location: /");
    exit;
}