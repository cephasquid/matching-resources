<?php
/**
 * User: David Olsen
 * Date: 4/28/15
 * Time: 3:11 PM
 */

require_once("database.php");


function addNeed($login,$what,$amount, $location,$extended_location) {
    $need = R::dispense('need');
    $need -> item = $what;
    $need -> amount = $amount;
    $need -> extended_location = $extended_location;
    $need -> who = $login;
    R::store($need);

}

function addBeingFulfilled($login,$needID) {
    $need = R::load('need', $needID);
    $need->fulfilled = "true";
    $need->fulfilledby = $login;
    R::store($need);
}

function listNeeds() {

    $db_needs = R::findAll('need');
    return $db_needs;
}

function listUnfulfilled() {
    $db_needs = R::find('need',' fulfilled is not null');
    return $db_needs;
}

function listFulfilled() {
    $db_needs = R::find('need', 'fulfilled is null');
    return $db_needs;
}

function getNeed($needID) {
    $need = R::load('need', $needID);
    return $need;
}