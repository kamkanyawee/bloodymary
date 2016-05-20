<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //Component Implementation
    class Account {
        public static function login($username, $password) {
            $conn = new mysqli("127.0.0.1", "root", "", "bloodymary");
            if($conn->connect_errno) {
                $conn->close();
                return -1;
            }
            $username = $conn->real_escape_string($username);
            $password = $conn->real_escape_string($password);
            if (session_status() == PHP_SESSION_NONE) session_start();
            session_unset();
            $result = $conn->query(
                "SELECT *
                FROM customer
                WHERE Username = '".$username."' AND Password = '".$password."';"
            );
            $userinfo = $result->fetch_array(MYSQL_ASSOC);
            if($userinfo == null) {
                $_SESSION['authen'] = 0;
                $conn->close();
                return 0;
            }
            else {
                $_SESSION['authen'] = 1;
                $_SESSION['userinfo'] = $userinfo;
                $conn->close();
                return 1;
            }
        }
        public static function logout() {
            if (session_status() == PHP_SESSION_NONE) session_start();
            session_unset();
            $_SESSION['authen'] = 0;
            $conn->close();
        }
        public static function create($username, $password, $fname, $lname, $email) {
            $conn = new mysqli("127.0.0.1", "root", "", "bloodymary");
            if($conn->connect_errno) {
                $conn->close();
                return -1;
            }
            $username = $conn->real_escape_string($username);
            $password = $conn->real_escape_string($password);
            $fname = $conn->real_escape_string($fname);
            $lname = $conn->real_escape_string($lname);
            $email = $conn->real_escape_string($email);
            $result = $conn->query(
                "SELECT *
                FROM customer
                WHERE Username = '".$username."' OR Email = '".$email."';"
            );
            $result = $result->fetch_array(MYSQL_ASSOC);
            if($result != null) {
                $conn->close();
                return 0;
            }
            else {
                $conn->query(
                    "INSERT INTO tb_user(Username, Password, FirstName, LastName, Email)
                    VALUES ('".$username."', '".$password."', '".$fName."', '".$lName."', '".$email.");"
                );
                $conn->close();
                return 1;
            }
        }
        public static function authenticate() {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if(!isset($_SESSION["authen"])) $_SESSION["authen"] = 0;
            return $_SESSION['authen'];
        }
        public static function getuserinfo() {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if(!isset($_SESSION['userinfo'])) return null;
            else return $_SESSION['userinfo'];
        }
    }
    //Server-Client Interface
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
        echo json_encode(array('authen'=>Account::authenticate(), 'userinfo'=>Account::getuserinfo(), 'cart'=>[]));
    }
?>
