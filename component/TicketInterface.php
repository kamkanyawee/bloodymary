<?php
    require_once("Ticket.php");

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    if(isset($_POST['flightid'])) echo json_encode(Ticket::getTicketInfo($_POST['flightid']));
    else echo json_encode(Ticket::filterTicket());
?>
