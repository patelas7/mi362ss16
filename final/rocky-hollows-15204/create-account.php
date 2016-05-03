<?php
$open = true;
require 'lib/todo.inc.php';
$view = new TodoList\View();
$view->setTitle("Create Account");
$view->setMsg($_GET, $_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="createpage">
    <?php echo $view->header(); ?>

    <form class="createform" method="post" action="post/login.php">
        <fieldset>
            <legend>Create Account</legend>
            <?php echo $view->getMsg(); ?>
            <p>
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" placeholder="Name">
            </p>
            <p>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" placeholder="Password">
            </p>
            <p>
                <label for="confirm-password">Password (confirm):</label><br>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Password">
            </p>
            <p>
                <input type="submit" name= "submitCreate" value="Create Account">
            </p>
            <p></p>

        </fieldset>
    </form>



</div>

</body>
</html>
