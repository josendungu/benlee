<?php 
include_once 'php/core/init.php';


session_start();
    if(isset($_POST['Login'])){

        if(empty($_POST['username']) || empty($_POST['password']))
        {
             header("location:admin-login.php?Empty= Please Fill in the Blanks");
        } else {

            $username = Input::get('username');
            $password = Input::get('password');

            $user = new User();

            if($user->validateAdmin($username, $password)){
                $_SESSION['User']=$username;
                header("location:admin.php");
            } else {
                header("location:admin-login.php?Invalid= Please Enter Correct User Name and Password ");
            }

        }

    } else {
        header("location:admin-login.php?Invalid= Some error occured ");
    }

?>