<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

//Include class Position
require("classes/Position.php");

//Include class Nominees
require("classes/Nominees.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">

    <script>
        function getPos(val) {
            $.ajax({
                type: "POST",
                url: "get_pos.php",
                data: 'org='+val,
                success: function(data) {
                    $("#pos-list").html(data);
                }
            });
        }
    </script>
</head>
<body>

<!-- Header -->

<!-- End Header -->

<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <?php
            if(isset($_GET['id'])) {
                $nom_id = trim($_GET['id']);

                echo "<div class='alert alert-danger'>Are you sure you want to delete selected nominee? <a href='/spccvotingsystem/admin/delete_nominee.php?del_id=$nom_id'>Yes</a> | <a href='/spccvotingsystem/admin/add_nominees.php'>No</a></div>";
            }


            if(isset($_GET['del_id'])) {
                $id_to_del = $_GET['del_id'];

                $delNom = new Nominees();
                $rtnDelNom = $delNom->DELETE_NOMINEE($id_to_del);
            }
            ?>
        </div>
    </div>
</div>






<!-- Footer -->

<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>