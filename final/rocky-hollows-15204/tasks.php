<?php
require 'lib/todo.inc.php';
$view = new TodoList\TasksView($site, $_SESSION);
$view->setMsg($_GET, $_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $view->head(); ?>
</head>

<body>
<div class="task">
<?php
echo $view->header();
echo $view->present();
?>
</div>

<div class="overlay">
	<?php echo $view->presentOverlay(); ?>
</div>

</body>
</html>
