<?php
/**
 * User: David Olsen
 * Date: 4/28/15
 * Time: 3:11 PM
 */

require_once('Needs.php');
session_start();
$needs = listNeeds();
?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="http://connect.facebook.net/en_US/all.js"></script>
 </head>
<body>

    <script type="text/javascript">

        var add_need = function (event) {

            var items =  {
                item: $('#item').val(),
                amount: $('#amount').val(),
                location_extended: $('#location_extended').val()
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



       <form method="post" onsubmit="return false;">
           <input type="text" name="item" id="item"/> <br/>
           <input type="text" name="amount" id="amount"/> <br/>
           <input type="text" name="location_extended" id="location_extended"/> <br/>
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
                print $need->$who;
                print "</td>";
                print "<td>";
                print $need->item;
                print "</td>";

                print "<td>";
                print $need->amount;
                print "</td>";
                print "<td>";
                print $need->location;
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