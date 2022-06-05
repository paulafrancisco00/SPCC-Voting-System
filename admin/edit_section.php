<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Nominees
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
    <link rel="stylesheet" href="../assets/css/zoom.css">


    <script>
        function getPos(val) {
            $.ajax({
                type: "POST",
                url: "get_pos.php",
                data: 'partylist='+val,
                success: function(data) {
                    $("#pos-list").html(data);
                }
            });
        }
    </script>
</head>
<body>

   <?php 
   include('sidebar.php');

   ?>
   <!-- End Header -->




   <br><br>
   <div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto" style="zoom: 90%;">
            <?php
            if(isset($_POST['update'])) {

                $grade   = trim($_POST['grade']);
                $strand       = trim($_POST['strand']);
                $section       = trim($_POST['section']);
                $section_id    = trim($_POST['section_id']);

                $updateSection = new Section();
                $rtnupdateSection = $updateSection->UPDATE_SECTION($grade, $strand, $section, $section_id);

            }
            ?>
            <h4>Edit Nominee</h4><hr>

            <?php
            if(isset($_GET['id'])) {
                $nom_id = trim($_GET['id']);
                $editSection = new Section();
                $rtnEditSection = $editSection->EDIT_SECTION($nom_id);
                if($rtnEditSection){
                    $rowSection = $rtnEditSection->fetch_assoc();
                    $rtnEditSection->free();
                }else{
                    header("Location: add_section.php");
                }
            }
            ?>


            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form"  enctype="multipart/form-data">
                <div class="form-group-sm">
                    <label for="grade">Grade</label>
                    <select required name="grade" class="form-control">
                        <?php 
                        $grade = [11,12];
                        foreach($grade as $g){
                            echo '<option value="'.$g.'" '.(($rowSection['grade']==$g)?"selected":"").'>'.$g.'</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group-sm">
                    <label for="strand">Strand</label>
                    <select required name="strand" class="form-control">
                        <?php 
                        $strand = ["ICT","STEM","H.E","ABM","HUMSS", "GAS"];
                        foreach($strand as $s){
                            echo '<option value="'.$s.'" '.(($rowSection['strand']==$s)?"selected":"").'>'.$s.'</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group-sm">
                    <label for="section">Section</label>
                    <input required type="text" name="section" value="<?php echo $rowSection['section']; ?>" class="form-control">
                </div>
                <hr/>
                <div class="form-group-sm">
                    <input type="hidden" name="section_id" value="<?php echo $rowSection['id']; ?>">
                    <input type="submit" name="update" value="Update" class="btn btn-info">
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../assets/js/zoom.js"></script>

<script>
    var sym = "-";
    function randomNumber() {
      var x = document.getElementById("showRandNum")
  x.value = Math.floor((Math.random() * 1000000000) + 1); // 9 Max Digit
}

</script>
</body>
</html>