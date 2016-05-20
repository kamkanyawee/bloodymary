<?php
    class Ticket{
        public static function getTicketInfo($flightid) {
            $conn = new mysqli("127.0.0.1", "root", "", "bloodymary");
            if($conn->connect_errno) {
                $conn->close();
                return -1;
            }
            $flightid = $conn->real_escape_string($flightid);
            $result = $conn->query(
                "SELECT *
                FROM ticket
                WHERE FlightID = '".$flightid."';"
            );
            $conn->close();
            $flightinfo = $result->fetch_array(MYSQL_ASSOC);
            return $flightinfo;
        }
        public static function filterTicket($criteria = null) {
            $conn = new mysqli("127.0.0.1", "root", "", "bloodymary");
            if($conn->connect_errno) {
                $conn->close();
                return -1;
            }
            $flightlist = $conn->query("SELECT * FROM ticket;");
            $conn->close();
            $result = array();
            while($flight = $flightlist->fetch_array(MYSQLI_ASSOC)) $result[] = $flight;
            return $result;
        }
    }
?>
