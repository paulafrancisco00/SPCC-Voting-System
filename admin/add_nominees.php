
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

    <style>
        .row {
            margin-right: -15px !important;
            margin-left: -15px !important;
        }
    </style>

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

    <!-- Header -->
    <?php 
    include('sidebar.php');

    ?>
    <!-- End Header -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br><br>
                <?php
                if(isset($_POST['submit'])) {
                    $img =      trim($_FILES['img']['name']);
                    $org        = trim($_POST['organization']);
                    $pos        = trim($_POST['position']);
                    $last_name       = trim($_POST['last_name']);
                    $first_name       = trim($_POST['first_name']);
                    $middle_name       = trim($_POST['middle_name']);
                    $strand     = trim($_POST['strand']);
                    $grade     = trim($_POST['grade']);
                //    $section     = trim($_POST['section']);
                    $student_number    = trim($_POST['student_number']);

                    $target_dir = "images/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } 

                    else {
                        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {} 
                    }

                if (file_exists($target_file)) {

                    $uploadOk = 0;
                }

                $insertNominee = new Nominees();
                $rtnInsertNominee = $insertNominee->INSERT_NOMINEE($img, $org, $pos, $last_name, $first_name, 
                    $middle_name, $strand, $grade, $student_number); 
            }

            ?>
            <h4 style="display: inline;">List of Nominees</h4>
            <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#AddNominees">Add New Nominee</button>
            <hr>

            <?php
            $readNominees = new Nominees();
            $rtnReadNominees = $readNominees->READ_NOMINEE();
            ?>

            <div class="col-md-12">
                <?php if($rtnReadNominees) { ?>
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                            <th>Image</th>
                            <th>Party List</th>
                            <th>Position</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Strand/Grade</th>
                           <!-- <th>Section</th> -->
                            <th>Student Number</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <?php while($rowNom = $rtnReadNominees->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo "<img src='images/".$rowNom['img']."'width='150' class=''"; ?></td>
                                <td><?php echo $rowNom['partylist']; ?></td>
                                <td><?php echo $rowNom['pos']; ?></td>
                                <td><?php echo $rowNom['last_name']; ?></td>
                                <td><?php echo $rowNom['first_name']; ?></td>
                                <td><?php echo $rowNom['middle_name']; ?></td>

                                <td><?php echo $rowNom['strand'] . "-" . $rowNom['grade']; ?></td>
                             <!--   <td><?php echo $rowNom['section']; ?></td> -->

                                <td><?php echo $rowNom['student_number']; ?></td>

                                <td>
                                    <a href="/spccvotingsystem/admin/edit_nominee.php?id=<?php echo $rowNom['id']; ?>">
                                        <button class="btn btn-warning">Update</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="/spccvotingsystem/admin/delete_nominee.php?id=<?php echo $rowNom['id']; ?>">
                                        <button class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php } //End while ?>
                        <?php $rtnReadNominees->free(); ?>
                    </table>
                <?php } //end if ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddNominees" style="zoom: 90%;">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Party List</h4><hr>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="zoom: 95%;">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form" 
                        enctype="multipart/form-data">
                        <?php
                        $readOrg = new Organization();
                        $rtnReadOrg = $readOrg->READ_ORG();
                        ?>
                        <div class="form-group-sm">   
                            <label for="img">Image</label>               
                            <div class="custom-file">
                              <!--<img src='images/' +  fileName id="imgPreview" width='200' > -->

                                <input type="file" class="custom-file-input" name="img">
                                <label class="custom-file-label" for="img" id="imgLabel">Choose file</label>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group-sm col-md-6">
                            <label for="organization">Party List</label>
                            <?php if($rtnReadOrg) { ?>
                                <select required name="organization" class="form-control" id="org-list" onchange="getPos(this.value);">
                                    <option value=""></option>
                                    <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                                        <option value="<?php echo $rowOrg['partylist']; ?>"><?php echo $rowOrg['partylist']; ?></option>
                                    <?php } //End while ?>
                                </select>
                                <?php $rtnReadOrg->free(); ?>
                            <?php } //End if ?>
                        </div>
                        <div class="form-group-sm col-md-6">
                            <label for="position">Position</label>
                            <select required name="position" class="form-control" id="pos-list">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                        <div class="row">
                        
                        <div class="form-group-sm col-md-4">
                            <label for="last_name">Last Name</label>
                            <input required type="text" name="last_name" class="form-control">
                        </div>
                        <div class="form-group-sm col-md-4">
                            <label for="first_name">First Name</label>
                            <input required type="text" name="first_name" class="form-control">
                        </div>
                        <div class="form-group-sm col-md-4">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="form-group-sm col-md-6">
                            <label for="grade">Grade</label>
                            <select required name="grade" class="form-control" id="grade">
                                    <option value="" disabled selected hidden></option>
                                    <?php 
                                    $grade = [11,12];
                                    foreach($grade as $g){
                                        echo '<option value="'.$g.'">'.$g.'</option>';
                                    }
                                    ?>
                                </select>
                        </div>

                        <div class="form-group-sm col-md-6">
                            <label for="strand">Strand</label>
                                <select required name="strand" class="form-control" id="strand">
                                    <option value="" disabled selected hidden></option>
                                    <?php 
                                    $strand = ["ICT","STEM","H.E","ABM","HUMSS", "GAS"];
                                    foreach($strand as $s){
                                        echo '<option value="'.$s.'">'.$s.'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <!--
                        <div class="form-group-sm col-md-4">
                           <label for="section">Section</label>
                                <select required name="section" class="form-control" id="section" disabled>
                                </select>
                        </div>
                    -->
                    </div>
                        <label for="student_number">Student Number</label>
                        <div class="input-group">
                            <input type="number" name="student_number" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            maxlength = "9" id="showRandNum">
                        </div>
                        <hr/>
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
</div>


<!-- Footer -->

<!-- End Footer -->

<script src="../assets/js/zoom.js"></script>
<script>
    var sym = "-";
    function randomNumber() {
        var x = document.getElementById("showRandNum")
        x.value = Math.floor((Math.random() * 1000000000) + 1);
    }

    $('table').DataTable();

    $('input[type="file"]'). change(function(e){
    fileName = e. target. files[0]. name;
    $('#imgLabel').text(fileName);
    $('#imgPreview').attr('src','images/'+fileName);
});



      $("#grade_strand_section").on('change',function(){
            var selected = $(this).find('option:selected').text();
            var split = selected.split(" - ");
            $("#grade").val(split[0]);
            $("#strand").val(split[1]);
            $("#section").val(split[2]);
        });

        $(function() {
            otable = $('table').dataTable();
        });

        function filterme(key) {
          var gradebox = $('input:checkbox[name="gradebox"]:checked').map(function() {
            return '^' + this.value + '\$';
        }).get().join('|');
          otable.fnFilter(gradebox, 4, true, false, false, false);

          var strandbox = $('input:checkbox[name="strandbox"]:checked').map(function() {
            return '^' + this.value + '\$';
        }).get().join('|');
          otable.fnFilter(strandbox, 5, true, false, false, false);

          var sectionbox = $('input:checkbox[name="sectionbox"]:checked').map(function() {
            return '^' + this.value + '\$';
        }).get().join('|');
          otable.fnFilter(sectionbox, 6, true, false, false, false);
      }

      $(document).on('click', '.btn-group .dropdown-menu', function (e) {
        e.stopPropagation();
    });

      $(".gradebox, .strandbox").click(function(){
        var gradeboxArr = [];
        var strandboxArr = [];
        var i = 0;
        var j = 0;
        $('.gradebox:checked').each(function () {
            gradeboxArr[i++] = $(this).val();
        });

        $('.strandbox:checked').each(function () {
            strandboxArr[j++] = $(this).val();
        });
        getSections(gradeboxArr, strandboxArr);
    });

      function getSections(grade, strand){
        $.ajax({
            url: "classes/GetSections.php",
            method: "POST",
            dataType: "text",
            data: {
                key: "get_sections",
                grade: grade,
                strand: strand,
            }, error: function(response){
                alert(response);
            }, success: function(response){
                $("#section_box").html(response);
            }
        });
    }

    $('#grade, #strand').change(function(){
        grade = $("#grade").val();
        strand = $("#strand").val();

        if(grade != null && strand != null){
            $.ajax({
                url: "classes/GetSections.php",
                method: "POST",
                dataType: "text",
                data: {
                    key: "sections",
                    grade: grade,
                    strand: strand,
                }, error: function(response){
                    alert(response);
                }, success: function(response){
                    $("#section").find('option').remove().end().append(response).removeAttr('disabled');
                }
            });
        }

    });
</script>

</body>
</html>