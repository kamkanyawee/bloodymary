<?php
    require_once("Account.php");
    require_once("Ticket.php");

    //Component Implementation
    class Cart {
        public static function addtocart($flightid) {
            if(Account::authenticate() != 1) return 0;
            if(session_status() == PHP_SESSION_NONE) session_start();
            if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
            $ticket = Ticket::getTicketInfo($flightid);
            foreach($_SESSION['cart'] as &$i)
                if($i['item'] == $ticket) {
                    $i['qty'] += 1;
                    return 1;
                }
            $_SESSION['cart'][] = array('item'=>$ticket, 'qty'=>1);
            return 1;
        }
        public static function removefromcart($flightid) {
            if(Account::authenticate() != 1) return 0;
            if(session_status() == PHP_SESSION_NONE) session_start();
            $newcart = array();
            if(sizeof($_SESSION['cart']) != 0) {
                foreach($_SESSION['cart'] as &$i) {
                    if($i['item']['FlightID'] == $flightid) {
                        $i['qty'] -= 1;

                    }
                    if($i['qty'] > 0) $newcart[] = $i;
                }
                $_SESSION['cart'] = $newcart;
            }
            return 1;
        }
        public static function gettotalfare() {
            if(Account::authenticate() != 1) return 0;
            if(session_status() == PHP_SESSION_NONE) session_start();
            $totalfare = 0.00;
            foreach($_SESSION['cart'] as $i) $totalfare += ($i['qty'] * $i['item']['Fare']);
            return $totalfare;
        }
        public static function getcart() {
            if(Account::authenticate() == 1) {
                if(session_status() == PHP_SESSION_NONE) session_start();
                if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
                return $_SESSION['cart'];
            } else return null;
        }
    }
?>
