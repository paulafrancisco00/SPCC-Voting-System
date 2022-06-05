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
            <div class="mx-auto">
                <?php
                if(isset($_POST['update'])) {
                    $img =      trim($_FILES['img']['name']);
                    $org        = trim($_POST['organization']);
                    $pos        = trim($_POST['position']);
                    $last_name       = trim($_POST['last_name']);
                    $first_name       = trim($_POST['first_name']);
                    $middle_name       = trim($_POST['middle_name']);
                    $strand     = trim($_POST['strand']);
                    $grade     = trim($_POST['grade']);
                   // $section     = trim($_POST['section']);
                    $student_number    = trim($_POST['student_number']);
                    $nominee_id = trim($_POST['nom_id']);


                    $target_dir = "images/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
                    }else {
                        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {} 
                    }

                if (file_exists($target_file)) {

                    $uploadOk = 0;
                }

                $updateNominee = new Nominees();
                $rtnUpdateNominee = $updateNominee->UPDATE_NOMINEE($img, $org, $pos, $last_name, $first_name, $middle_name, $strand, $grade, $student_number, $nominee_id);

            }
            ?>
            <h4>Edit Nominee</h4><hr>

            <?php
            if(isset($_GET['id'])) {
                $nom_id = trim($_GET['id']);

                $editNominee = new Nominees();
                $rtnEditNominee = $editNominee->EDIT_NOMINEE($nom_id);
            }
            ?>

            <?php if($rtnEditNominee) { ?>
                <?php while($rowNominee = $rtnEditNominee->fetch_assoc()) { ?>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form"  enctype="multipart/form-data">
                        <?php
                        $readOrg = new Organization();
                        $rtnReadOrg = $readOrg->READ_ORG();
                        ?>
                        <div class="form-group-sm">
                            <center>
                                <img src='images/<?php echo $rowNominee['img']; ?>' id="imgPreview" width='200' 
                                value="<?php echo $rowNominee['img']; ?>" >
                            </center>
                            <label for="img">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control" name="img" value="<?php echo $rowNominee['img']; ?>">
                                <label class="custom-file-label" for="img" id="imgLabel">Choose file</label>
                            </div>
                            <br><br>
                            
                        </div>
                        
                        <div class="form-group-sm">
                            <label for="organization">Party List</label>
                            <?php if($rtnReadOrg) { ?>
                                <select required name="organization" class="form-control" id="org-list" onchange="getPos(this.value);">
                                    <option value="<?php echo $rowNominee['partylist']; ?>"><?php echo $rowNominee['partylist']; ?></option>
                                    <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                                        <option value="<?php echo $rowOrg['partylist']; ?>"><?php echo $rowOrg['partylist']; ?></option>
                                    <?php } //End while ?>
                                </select>
                                <?php $rtnReadOrg->free(); ?>
                            <?php } //End if ?>
                        </div>
                        
                        <div class="form-group-sm">
                            <label for="position">Position</label>
                            <select required name="position" class="form-control" id="pos-list">
                                <option value="<?php echo $rowNominee['pos']; ?>"><?php echo $rowNominee['pos']; ?></option>
                            </select>
                        </div>
                        <div class="row">
                        <div class="form-group-sm col-md-4">
                            <label for="name">Last Name</label>
                            <input required type="text" name="last_name" class="form-control" value="<?php echo $rowNominee['last_name']; ?>">
                        </div>
                        
                        <div class="form-group-sm col-md-4">
                            <label for="name">First Name</label>
                            <input required type="text" name="first_name" class="form-control" value="<?php echo $rowNominee['first_name']; ?>">
                        </div>
                       
                        <div class="form-group-sm col-md-4">
                            <label for="name">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="<?php echo $rowNominee['middle_name']; ?>">
                        </div>
                       </div>
                       <div class="row">

                        <div class="form-group-sm col-md-6">

                            <label for="strand">Strand</label>
                            <select required name="strand" class="form-control">
                                <option value="<?php echo $rowNominee['strand']; ?>"><?php echo $rowNominee['strand']; ?></option>
                                <option value="ICT">ICT</option>
                                <option value="STEM">STEM</option>
                                <option value="H.E">H.E</option>
                                <option value="ABM">ABM</option>
                                <option value="GAS">GAS</option>
                                <option value="HUMSS">HUMSS</option>
                            </select>
                        </div>
                        
                        <div class="form-group-sm col-md-6">
                            <label for="grade">Year</label>
                            <select required name="grade" class="form-control">
                                <option value="<?php echo $rowNominee['grade']; ?>"><?php echo $rowNominee['grade']; ?></option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        
                        <!--
                        <div class="form-group-sm col-md-4">
                            <label for="section">Section</label>
                            <select required name="section" class="form-control">
                                <option value="<?php echo $rowNominee['section']; ?>"><?php echo $rowNominee['section']; ?></option>
                                <?php 
                                echo "<option></option>";
                                foreach(range('A','Z') as $v){

                                    echo "<option value='$v'> $v \n </option>";
                                }
                                ?>

                            </select>
                        </div>
                    -->
                        </div>


                        <label for="student_number">Student Number</label>
                        <div class="input-group">
                            <input type="number" name="student_number" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                            maxlength = "9" id="showRandNum" value="<?php echo $rowNominee['student_number']; ?>">
                            <!--
                            <div class="input-group-btn">

                                <button disabled="" class="btn btn-outline-secondary" type="button" onclick="randomNumber()">
                                    Generate Student Number
                                </button>
                            </div>
                        -->
                        </div>



                        <hr/>
                        <div class="form-group-sm">
                            <input type="hidden" name="nom_id" value="<?php echo $rowNominee['id']; ?>">
                            <input type="submit" name="update" value="Update" class="btn btn-info">
                        </div>
                        <br>
                    </form>
                <?php } //End while ?>
                <?php $rtnEditNominee->free(); ?>
            <?php } //End if ?>
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

$('input[type="file"]'). change(function(e){
    fileName = e. target. files[0]. name;
    $('#imgLabel').text(fileName);
    $('#imgPreview').attr('src','images/'+fileName);
});

</script>
</body>
</html>