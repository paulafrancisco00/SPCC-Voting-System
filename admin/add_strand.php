<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class grade
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
        <div class="col-md-12">
            <?php

            if(isset($_POST['submit'])) {

                $grade   = trim($_POST['grade']);
                $strand            = trim($_POST['strand']);

                $insertPos = new Strand();
                $rtnInsertPos = $insertPos->INSERT_STRAND($grade, $strand);
            }
            ?>
        
        <?php
        $readPos = new Strand();
        $rtnReadPos = $readPos->READ_STRAND();
        ?>
<h4 style="display: inline;">List of Positions</h4>
            <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#AddPosition">Add New Strand</button>
            <hr>
            <div class="table-responsive">
                <?php if($rtnReadPos) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Strand</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowPos['strand']; ?></td>
                        <td><a href="/spccvotingsystem/admin/edit_strand.php?id=<?php echo $rowPos['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
                        <td><a href="/spccvotingsystem/admin/delete_strand.php?id=<?php echo $rowPos['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                    <?php $rtnReadPos->free(); ?>
                <?php } //End if ?>
            </div>
    </div>
</div>


<div class="modal fade" id="AddPosition">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Strand</h4><hr>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                
                <div class="form-group-sm">
                    <label for="grade">Grade</label>
                    <select required name="grade" class="form-control">
                        <option value="" selected>Select Grade</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="form-group-sm">
                    <label for="strand">Strand</label>
                    <input required type="text" name="strand" class="form-control">
                </div><hr/>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
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



<!-- Footer -->

<!-- End Footer -->

</body>
</html>


<?php
//Close database connection
$db->close();