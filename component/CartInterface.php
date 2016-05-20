<?php
    require_once("Cart.php");

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    if(isset($_POST['function'])) {
        if($_POST['function'] == 'add') {
            if(isset($_POST['flightid'])) {
                echo '{"response":'.Cart::addtocart($_POST['flightid']).'}';
            } else {
                echo '{"response":0}';
            }
        } else if($_POST['function'] == 'remove') {
            if(isset($_POST['flightid'])) {
                echo '{"response":'.Cart::removefromcart($_POST['flightid']).'}';
            } else {
                echo '{"response":0}';
            }
        }
    } else {
        echo json_encode(array("totalfare"=>Cart::gettotalfare(), "lineitem"=>Cart::getcart()));
    }
?>
