<?php
/**
 * User: David Olsen
 * Date: 4/28/15
 * Time: 7:47 PM
 */


function latLngToString($lat,$lng) {
    return "$lat $lng";
}

function stringToLatLng($string) {
    $array = preg_split("/ /",$string);
    return $array;
}