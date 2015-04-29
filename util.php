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

function labeledLatLng($string) {
    $array = stringToLatLng($string);

    return "lat: $array[0], lng: $array[1]";
}