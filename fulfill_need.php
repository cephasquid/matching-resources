<?php
/**
 * User: David Olsen
 * Date: 4/28/15
 * Time: 6:18 PM
 */


session_start();
require_once("Needs.php");

$needid = $_POST["needID"];
$login = $_SESSION["login"];
if($login) {
    addBeingFulfilled($login,$needid);
}
else {
    http_response_code(403);

}

