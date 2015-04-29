<?php

require_once("database.php");


function addNeed($login,$what,$amount, $location,$extended_location) {
    $need = R::dispense('need');
    $need -> item = $what;
    $need -> amount = $amount;
    $need -> extended_location = $extended_location;
    $need -> who = $login;
    R::store($need);

}

function addBeingFulfilled($login,$needID, $who) {
    $need = R::load('need', $needID);
    $need->fullfilled = "true";
    $need->beingFullfilledby = $who;
    R::store($need);
}

function listNeeds() {

    $db_needs = R::findAll('need');
    return $db_needs;
}

function listUnfulfilled() {
    $db_needs = R::find('need',' fullfilled is not null');
    return $db_needs;
}

function listFulfilled() {
    $db_needs = R::find('need', 'fullfilled is null');
    return $db_needs;
}

function getNeed($needID) {
    $need = R::load('need', $needID);
    return $need;
}