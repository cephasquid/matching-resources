<?php
/**
 * User: David Olsen
 * Date: 4/28/15
 * Time: 3:11 PM
 */
require_once("util.php");
require_once('Needs.php');

session_start();
$needs = listNeeds();
?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <style>
        html, body {
            height: 100%;
            margin: 0px;
            padding: 0px
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>


    <script type="text/javascript">

        var latlngString = function(lat,lng) {
            return ""+lat+" "+lng;
        };
        var add_need = function (event) {



            var items =  {
                item: $('#item').val(),
                amount: $('#amount').val(),
                location_extended: $('#location_extended').val(),
                location: latlngString($('#lat').val(), $('#lng').val())
            };

            $.ajax({
                url: "add_need.php",
                type: "post",
                data: items
            })
                .done(function(data) {
                    alert("done");
                    window.location.reload();

                })
                .fail(function(data) {
                    alert("Please login");
                });
        };
    var fulfill_need = function(needID) {
        var items =  {needID: needID};
        $.ajax({
            url: "fulfill_need.php",
            type: "post",
            data: items
        })
            .done(function(data) {
                alert("done");
                window.location.reload();

            })
            .fail(function(data) {
                alert("Please login");
            });

    };
    </script>

    <script type="text/javascript">

        var map;
        function initialize() {

            var mapOptions = {
                zoom: 4,
                center: new google.maps.LatLng(-34.397, 150.644)
            };

            map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = new google.maps.LatLng(position.coords.latitude,
                        position.coords.longitude);
                    map.setCenter(pos);
                })
            }
            google.maps.event.addListener(map, 'click', function(e) {
                placeMarker(e.latLng, map);

            });
        }
        var marker = null;
        function placeMarker(position, map) {
            if(marker) {
                marker.setMap(null);
            }
            marker = new google.maps.Marker({
                position: position,
                map: map
            });
            console.log(position);
            $("#lat").val(position.lat());
            $("#lng").val(position.lng());
            map.panTo(position);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>

    Add a new need

    <div id="map-canvas" style="height: 25%; width: 25%"></div>
       <form method="post" onsubmit="return false;">
           Item: <input type="text" name="item" id="item"/> <br/>
           Amount (with units) <input type="text" name="amount" id="amount"/> <br/>
           Latitude: <input type="text" name="lat" id="lat"/><br/>
           Longitude: <input type="text" name="lng" id="lng"/> <br/>
           Location description: <input type="text" name="location_extended" id="location_extended"/> <br/>
           <button onclick="add_need();">Add a need</button>
       </form>
   <table>
       <thead>
         <th>Name</th>
         <th>Items</th>
         <th>Amount</th>
         <th>Location </th>
         <th>Location Description</th>
         <th>Fulfilled</th>
         <th> Fulfilled By </th>
       </thead>
       <tbody>
       <?php

            foreach ($needs as $need) {
                print "<tr>";
                print "<td>";
                print $need->who;
                print "</td>";
                print "<td>";
                print $need->item;
                print "</td>";

                print "<td>";
                print $need->amount;
                print "</td>";
                print "<td>";
                print labeledLatLng($need->location);
                print "</td>";
                print "<td>";
                print $need -> extended_location;
                print "</td>";
                print "<td>";
                print $need->fulfilled;
                print "</td>";
                print "<td>";
                print $need->fulfilledby;
                print "</td>";
                print "<td>";
                $needid = $need->id;
                print "<button onclick=\"fulfill_need($needid);\">Fulfill This Need</button>";
                print "</td>";

                print "</tr>";
            }
        ?>
       </tbody>
</table>
</body>
</html>