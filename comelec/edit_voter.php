<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");

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
            <div class="mx-auto">
                <?php
                if(isset($_POST['update'])) {
                    $student_number    = trim($_POST['student_number']);
                    $last_name       = trim($_POST['last_name']);
                    $first_name       = trim($_POST['first_name']);
                    $middle_name       = trim($_POST['middle_name']);
                    $section_id     = trim($_POST['section']);
                    $voters_code     = trim($_POST['voters_code']);
                    $status     = trim($_POST['status']);
                    $voter_id   = trim($_GET['id']);


                    $updateVoter = new Voters();
                    $rtnUpdateVoter = $updateVoter->UPDATE_VOTER($student_number, $last_name, $first_name, $middle_name, 
                        $section_id, $voters_code, $status, $voter_id);
                }
                ?>
                <h4>Edit Voter</h4><hr>
                <?php
                if(isset($_GET['id'])) {
                    $id = trim($_GET['id']);

                    $editVoter = new Voters();
                    $rtnEditVoter = $editVoter->EDIT_VOTER($id);
                }
                ?>

                <?php if($rtnEditVoter) { ?>
                    <?php $row = $rtnEditVoter->fetch_assoc(); ?>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                        <div class="form-group-sm">
                            <label for="student_number">Student Number</label>
                            <input value="<?php echo $row['student_number']; ?>" required type="number" name="student_number" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "9">
                        </div> 
                        <div class="row">
                            <div class="form-group-sm col-md-4">
                                <label for="last_name">Last Name</label>
                                <input value="<?php echo $row['last_name']; ?>" required type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group-sm col-md-4">
                                <label for="first_name">First Name</label>
                                <input value="<?php echo $row['first_name']; ?>" required type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group-sm col-md-4">
                                <label for="middle_name">Middle Name</label>
                                <input value="<?php echo $row['middle_name']; ?>" type="text" name="middle_name" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group-sm col-md-4">
                                <label for="grade">Grade</label>
                                <select required name="grade" class="form-control" id="grade">
                                    <option value="" disabled selected hidden>Select Grade</option>
                                    <?php 
                                    $grade = [11,12];
                                    foreach($grade as $g){
                                        echo '<option value="'.$g.'" '.(($g == $row['grade'])?"selected":"" ).'>'.$g.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group-sm col-md-4">
                                <label for="strand">Strand</label>
                                <select required name="strand" class="form-control" id="strand">
                                    <option value="" disabled selected hidden>Select Strand</option>
                                    <?php 
                                    $strand = ["ICT","STEM","H.E","ABM","HUMSS","GAS"];
                                    foreach($strand as $s){
                                        echo '<option value="'.$s.'" '.(($s == $row['strand'])?"selected":"" ).'>'.$s.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group-sm col-md-4">
                                <label for="section">Section</label>
                                <select required name="section" class="form-control" id="section">
                                </select>
                            </div>
                        </div>
                        <label for="voters_code">Voters Code</label>
                        <div class="input-group">
                            <input value="<?php echo $row['voters_code'];?>" name="voters_code" type="number" class="form-control" readonly="readonly" maxlength="20" id="showRandNum">
                            <div class="input-group-btn">
                                <button disabled class="btn btn-outline-secondary" type="button" onclick="randomNumber()">
                                    Generate Voters Code
                                </button>
                            </div>
                        </div>

                        <div class="form-group-sm">
                            <label for="status">Status</label>
                            <select required name="status" class="form-control">
                                <option value="<?php echo $row['status']; ?>" selected hidden><?php echo $row['status']; ?></option>
                                <option value="active">Active</option>
                                <option disabled value="inactive">Inactive</option>
                            </select>
                        </div>



                        <hr>
                        <div class="form-group-sm">
                            <input type="submit" name="update" value="Update" class="btn btn-info btn-block">
                        </div>


                    </form>
                    <?php $rtnEditVoter->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>

   
    <script>
        var sym = "-";
        function randomNumber() {
          var x = document.getElementById("showRandNum")
          x.value = Math.floor((Math.random() * 10000000) + 1); // 9 Max Digit
      }

      function undisableTxt() {
          document.querySelector(".myText").disabled = false;
      }

      loadSections('<?php echo $row['grade'];?>','<?php echo $row['strand'];?>','<?php echo $row['section'];?>');
      function loadSections(grade, strand, section){
        $.ajax({
            url: "classes/GetSections.php",
            method: "POST",
            dataType: "text",
            data: {
                key: "sections",
                grade: grade,
                strand: strand,
                section: section
            }, error: function(response){
                alert(response);
            }, success: function(response){
                $("#section").find('option').remove().end().append(response).removeAttr('disabled');
            }
        });
    }
    $('#grade, #strand').change(function(){
        grade = $("#grade").val();
        strand = $("#strand").val();

        if(grade != null && strand != null){
            loadSections(grade,strand);
        }

    });

</script>
</body>
</html>