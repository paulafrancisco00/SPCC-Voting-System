<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Strand


require("classes/Section.php");

?>
    <!DOCTYPE HTML>
    <html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrator Login</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style_admin.css">
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
                    $pos_id = trim($_GET['id']);

                    echo "<div class='alert alert-danger'>Are you sure you want to delete selected strand? <a href='/spccvotingsystem/admin/delete_section.php?del_id=$pos_id'>Yes</a> | <a href='/spccvotingsystem/admin/add_section.php'>No</a></div>";
                }


                if(isset($_GET['del_id'])) {
                    $id_to_del = $_GET['del_id'];

                    $delPos = new Section();
                    $rtnDelPos = $delPos->DELETE_SECTION($id_to_del);
                }
                ?>
            </div>
        </div>
    </div>




    </body>
    </html>


<?php
//Close database connection
$db->close();