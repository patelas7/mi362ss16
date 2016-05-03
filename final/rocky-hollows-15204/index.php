<?php
$open = true;
require 'lib/todo.inc.php';
$view = new TodoList\HomeView();
$view->setMsg($_GET, $_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="mainpage">

<?php
echo $view->header();
echo $view->present();
?>

</div>

</body>
</html>
