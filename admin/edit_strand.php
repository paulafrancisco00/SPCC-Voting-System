<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Grade.php");

//Include class Position
require("classes/Strand.php");

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
      <?php 
    include('sidebar.php');
   
?>
    <!-- End Header -->


<br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">

                <?php
                if(isset($_POST['update'])) {
                    $strand       = trim($_POST['strand']);
                    $strand_id    = trim($_POST['strand_id']);

                    $updatePos = new Strand();
                    $rtnUpdatePos = $updatePos->UPDATE_STRAND($strand, $strand_id);
                }
                ?>

                <h4>Edit Position</h4><hr>

                <?php
                if(isset($_GET['id'])) {
                    $pos_id = trim($_GET['id']);

                    $editPos = new Strand();
                    $rtnEditPos = $editPos->EDIT_STRAND($pos_id);
                }
                ?>

                <?php if($rtnEditPos) { ?>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                    <?php while($rowEditPos = $rtnEditPos->fetch_assoc()) { ?>
                    <div class="form-group-sm">
                        <label for="strand">Strand</label>
                        <input required type="text" name="strand" value="<?php echo $rowEditPos['strand']; ?>" class="form-control">
                    </div><hr/>
                    
                    <div class="form-group-sm">
                        <input type="hidden" name="strand_id" value="<?php echo $rowEditPos['id']; ?>">
                        <input type="submit" name="update" value="Update" class="btn btn-info">
                    </div>
                    <?php } //End while ?>
                </form>
                <?php $rtnEditPos->free(); ?>
                <?php } //End if ?>
            </div>

        </div>
    </div>







    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    </body>
    </html>


<?php
//Close database connection
$db->close();