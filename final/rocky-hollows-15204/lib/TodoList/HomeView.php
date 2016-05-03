<?php
/**
 * Created by PhpStorm.
 * User: patelas7
 * Date: 4/25/2016
 * Time: 1:00 PM
 */

namespace TodoList;

class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("To-Do Lists");
        $this->addLink("create-account.php", "Create Account");
    }


    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<img src="images/notes.png" alt="Notes Picture">
<p>Welcome to the To-Do Lists Website!</p>
<p>Login or create an account to start keeping track of tasks that need to be completed.
This website allows you to keep a record of the things you want to get done
by the end of the week!</p>
<p><a href="instructions.php">About</a></p>
HTML;
    }

    public function present(){
        $html = '<form class="login" method="post" action="post/login.php"><fieldset><legend>Login</legend>';
        $html .= '<p class="message">' . $this->getMsg() . '</p>';
        $html .= <<<HTML
        <p>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
            <input type="submit" name="submitLogin" value="Log in">
        </p>
        <p></p>

    </fieldset>
</form>
HTML;
        return $html;

    }

}
