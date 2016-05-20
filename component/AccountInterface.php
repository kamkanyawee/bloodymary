<?php
    require_once("Account.php");

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    if(isset($_POST['function'])) {
        if($_POST['function'] == 'login') {
            if(isset($_POST['username']) and isset($_POST['password']))
                echo '{"response":'.Account::login($_POST['username'], $_POST['password']).'}';
            else
                echo '{"response":0}';
        } elseif($_POST['function'] == 'logout') {
            Account::logout();
        } elseif($_POST['function'] == 'create') {
            if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['fname']) and isset($_POST['lname']) and isset($_POST['email']))
                echo '{"response":'.Account::create($_POST['username'], $_POST['password'], $_POST['fname'], $_POST['lname'], $_POST['email']).'}';
            else
                echo '{"response":0}';
        }
    } else {
        echo json_encode(array('authen'=>Account::authenticate(), 'userinfo'=>Account::getuserinfo()));
    }
?>
