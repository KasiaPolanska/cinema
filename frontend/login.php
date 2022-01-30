<?php

require('../frontend/header.php');
include('../backend/login_controller.php');
$_SESSION['logged_in'] = false;
if(isset($_POST['btnOk']))
{
    
    $log = $_POST['login'];
    $pas = $_POST['password'];
    $_SESSION['login'] = $log;

    
    $logc = new Login();
    $logc->inloggen($log, $pas);
}

?>
    <div class="section">
        <div class="container">
        <div class="section-header">
                Log in
            </div>
            <form method="POST">
                <input name="login" type="text">
                <input name="password" type="password">
                <input name="btnOk" type="submit" value="OK"> 
                <p>Don't have an account yet? <strong><a href='registration.php'>Click here</a></strong><p>
            </form>
        </div>
    </div>
    <?php include('footer.php');?>