<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Grade.php");

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
        <div class="col-md-12">
             <?php
            if(isset($_POST['submit'])) {

                $grade = trim($_POST['grade']);

                $insertOrg = new Grade();
                $rtnInsertOrg = $insertOrg->INSERT_GRADE($grade);
            }
            ?>
            
            <h4 style="display: inline;">List of Grades</h4>
            <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#AddGrade">Add New Grade</button>
            <hr>

            <?php
            $readOrg = new Grade();
            $rtnReadOrg = $readOrg->READ_GRADE();
            ?>
            <div class="table-responsive">
                <?php if($rtnReadOrg) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Grade</th>
                        <th>Update</th>
                        <th>Delete</th>
                        
                    </tr>
                    <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowOrg['grade']; ?></td>
                        <td><a href="edit_grade.php?id=<?php echo $rowOrg['id']; ?>"      ><button class="btn btn-warning">Update</button></a></td>
                        <td><a href="delete_grade.php?id=<?php echo $rowOrg['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                <?php $rtnReadOrg->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="AddGrade">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Grade</h4><hr>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="organization">Grade</label>
                    <input required type="text" name="grade" class="form-control">
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
          <h4 class="modal-title">Add Grade</h4><hr>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           
             <?php
                if(isset($_POST['update'])) {

                    $grade    = trim($_POST['grade']);
                    $grade_id = trim($_POST['grade_id']);

                    $updateOrg = new Grade();
                    $rtnUpdateOrg = $updateOrg->UPDATE_GRADE($grade, $grade_id);
                }
                ?>
                <h4>Edit Grade</h4><hr>
                <?php
                if(isset($_GET['id'])) {
                    $grade_id = trim($_GET['id']);

                    $editOrg = new Grade();
                    $rtnEditOrg = $editOrg->EDIT_GRADE($grade_id);
                }
                ?>

                <?php if($rtnEditOrg) { ?>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                    <?php while($rowEditOrg = $rtnEditOrg->fetch_assoc()) { ?>
                    <div class="form-group-sm">
                        <label for="grade">Grade</label>
                        <input required type="text" name="grade" value="<?php echo $rowEditOrg['partylist']; ?>" class="form-control">
                    </div><hr>
                    <div class="form-group-sm">
                        <input type="hidden" name="grade_id" value="<?php echo $rowEditOrg['id']; ?>">
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