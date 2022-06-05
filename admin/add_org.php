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
    include('../assets/tags.php');
?>
<!-- End Header -->




<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
             <?php
            if(isset($_POST['submit'])) {

                $organization = trim($_POST['organization']);

                $insertOrg = new Organization();
                $rtnInsertOrg = $insertOrg->INSERT_ORG($organization);
            }
            ?>
            
            <h4 style="display: inline;">List of Party Lists</h4>
            <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#AddPartyList">Add New Party List</button>
            <hr>

            <?php
            $readOrg = new Organization();
            $rtnReadOrg = $readOrg->READ_ORG();
            ?>
            <div class="table-responsive">
                <?php if($rtnReadOrg) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Party List</th>
                        <th>Update</th>
                        <th>Delete</th>
                        
                    </tr>
                    <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowOrg['partylist']; ?></td>
                        <td><a href="edit_org.php?id=<?php echo $rowOrg['id']; ?>"      ><button class="btn btn-warning">Update</button></a></td>
                        <td><a href="delete_org.php?id=<?php echo $rowOrg['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                <?php $rtnReadOrg->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>
</div>
<!--
<div class="col-md-4">
            
            <?php
            if(isset($_POST['submit'])) {

                $organization = trim($_POST['organization']);

                $insertOrg = new Organization();
                $rtnInsertOrg = $insertOrg->INSERT_ORG($organization);
            }
            ?>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="organization">Party List</label>
                    <input required type="text" name="organization" class="form-control">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </div>
            </form>
        </div>
-->

<div class="modal fade" id="AddPartyList">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Party List</h4><hr>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="organization">Party List</label>
                    <input required type="text" name="organization" class="form-control">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                </div>
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
        </div>
        
      </div>
    </div>
  </div>




<div class="modal fade" id="UpdatePartyList">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Party List</h4><hr>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           
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
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
        </div>
        
      </div>
    </div>
  </div>

<!-- Footer -->

<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php
//Close database connection
$db->close();