<?php
/**
 * Created by PhpStorm.
 * User: patelas7
 * Date: 4/26/2016
 * Time: 5:09 PM
 */
namespace TodoList;

class LoginController{
    public function __construct(Site $site,  &$session, $post){

        $users = new Users($site);
        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $root = $site->getRoot();
        if(isset($post['submitLogin'])) {
            $user = $users->login($email, $password);
            //$user = null;
            if ($user === null) {
                // Login failed
                $this->redirect = "/index.php?e";
                $session[View::ERROR_MSG] = "Incorrect username or password";
                return;
            } else {
                $session[User::SESSION_NAME] = $user;
                $this->redirect = "/tasks.php";
            }
        }
        else if(isset($post['submitCreate'])){
            $confirm = strip_tags($post['confirm-password']);
            $name = $post['name'];
            if($name == ""){
                $session[View::ERROR_MSG] = "Please enter your name";
                $this->redirect = "/create-account.php?e";
                return;
            }
            if($email == ""){
                $session[View::ERROR_MSG] = "Please enter your email address";
                $this->redirect = "/create-account.php?e";
                return;
            }
            if($password !== $confirm){
                $session[View::ERROR_MSG] = "Passwords do not match";
                $this->redirect = "/create-account.php?e";
                return;
            }
            if(strlen($password) < 8){
                $session[View::ERROR_MSG] = "Password is too short";
                $this->redirect = "/create-account.php?e";
                return;
            }

            $ret = $users->createAccount($name, $email, $password);
            if($ret !== null){
                $session[View::ERROR_MSG] = $ret;
                $this->redirect = "/create-account.php?e";
                return;
            }
            $this->redirect = "/";
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    private $redirect;
}