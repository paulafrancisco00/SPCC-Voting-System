<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class grade
require("classes/Grade.php");

//Include class Strand
require("classes/Strand.php");

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
                $strand  = trim($_POST['strand']);
                $section  = trim($_POST['section']);


                $insertPos = new Section();
                $rtnInsertPos = $insertPos->INSERT_SECTION($grade, $strand, $section);
            }
            ?>
        
        <?php
        $readPos = new Section();
        $rtnReadPos = $readPos->READ_SECTION();
        ?>
<h4 style="display: inline;">List of Positions</h4>
            <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#AddPosition">Add New Strand</button>
            <hr>
            <div class="table-responsive">
                <?php if($rtnReadPos) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Grade</th>
                        <th>Strand</th>
                        <th>Section</th>             
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowPos['grade']; ?></td>
                        <td><?php echo $rowPos['strand']; ?></td>
                        <td><?php echo $rowPos['section']; ?></td>
                        <td><a href="/spccvotingsystem/admin/edit_section.php?id=<?php echo $rowPos['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
                        <td><a href="/spccvotingsystem/admin/delete_section.php?id=<?php echo $rowPos['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
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
                    <select required name="grade" class="form-control" id="grade-list">
                        <option value="" selected disabled hidden>Select Grade</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

                <div class="form-group-sm">
                    <label for="strand">Strand</label>
                    <select required name="strand" class="form-control" id="strand-list">
                        <option value="" selected disabled hidden>Select Strand</option>
                        <option value="ICT">ICT</option>
                        <option value="STEM">STEM</option>
                        <option value="H.E.">H.E.</option>
                        <option value="ABM">ABM</option>
                        <option value="HUMSS">HUMSS</option>
                        <option value="GAS">GAS</option>

                    </select>
                </div>
                    <div class="form-group-sm">
                    <label for="strand">Section</label>
                    <input required type="text" name="section" class="form-control">
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