<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

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

                    $organization    = trim($_POST['organization']);
                    $organization_id = trim($_POST['org_id']);

                    $updateOrg = new Organization();
                    $rtnUpdateOrg = $updateOrg->UPDATE_ORG($organization, $organization_id);
                }
                ?>
                <h4>Edit Party List</h4><hr>
                <?php
                if(isset($_GET['id'])) {
                    $org_id = trim($_GET['id']);

                    $editOrg = new Organization();
                    $rtnEditOrg = $editOrg->EDIT_ORG($org_id);
                }
                ?>

                <?php if($rtnEditOrg) { ?>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                    <?php while($rowEditOrg = $rtnEditOrg->fetch_assoc()) { ?>
                    <div class="form-group-sm">
                        <label for="organization">Party List</label>
                        <input required type="text" name="organization" value="<?php echo $rowEditOrg['partylist']; ?>" class="form-control">
                    </div><hr>
                    <div class="form-group-sm">
                        <input type="hidden" name="org_id" value="<?php echo $rowEditOrg['id']; ?>">
                        <input type="submit" name="update" value="Update" class="btn btn-info">
                    </div>
                    <?php } //End while ?>
                </form>
                <?php $rtnEditOrg->free(); ?>
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