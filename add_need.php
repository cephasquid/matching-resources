<?php
session_start();
require_once("Needs.php");
$what = $_POST["item"];
$amount = $_POST["amount"];
$location_extended = $_POST["location_extended"];
$login = $_SESSION["login"];
if($login) {
    addNeed($login, $what,$amount,"",$location_extended);
}
else {
    http_response_code(403);
}

