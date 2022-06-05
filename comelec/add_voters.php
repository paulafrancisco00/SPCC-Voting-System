<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");

require("classes/Grade.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comelec Login</title>
    <style>
        @media print {
            .noprint {
                display: none;
            }
            .dataTables_length, .dataTables_filter, .dataTables_info, ul.pagination {
                display: none;
            }
        }
    </style>
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
                    $student_number    = trim($_POST['student_number']);
                    $last_name       = trim($_POST['last_name']);
                    $first_name       = trim($_POST['first_name']);
                    $middle_name       = trim($_POST['middle_name']);
                    $section_id     = trim($_POST['section']);
                    $voters_code     = trim($_POST['voters_code']);
                    $status     = trim($_POST['status']);
                    $insertVoter = new Voters();
                    $rtnInsertVoter = $insertVoter->INSERT_VOTER($student_number, $last_name, 
                        $first_name, $middle_name, $section_id, $voters_code, $status);
                }
                ?>

                <?php
                $readVoters = new Voters();
                $rtnReadVoters = $readVoters->READ_VOTERS();
                ?>
                <center>
                    <div class="noprint">
                    <h4 style="display: inline;">List of Voters</h4>
                    <br>
                    <br>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#AddVoters">Add New Voter</button>

                   <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#MoveVoters">Restore Data</button>
-->

                    <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteVoters">Delete All Voters</button>
                </div>
                </center>
                <br>
                <!-- <input class="form-control myInput" style="float: right; width: 30%;"  placeholder="Search..."> -->



                <?php
                $readOrg = new Grade();
                $rtnReadGrade = $readOrg->READ_GRADE();
                ?>   
                <div class="noprint">
                <label>Filter By: </label>&nbsp;



                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                        Strand
                    </button>
                    <div class="dropdown-menu">
                        <div class="form-group-sm">
                            <?php 
                            $strandArr = ["ICT","STEM","H.E","ABM","HUMSS","GAS"];

                            foreach($strandArr as $s){
                                echo '
                                <div class="form-check dropdown-item">
                                <label class="form-check-label dropdown-item">
                                <input type="checkbox" name="strandbox" class="form-check-input strandbox" value="'.$s.'" onchange="filterme()">'.$s.'
                                </label>
                                </div>';        
                            }
                            ?>
                        </div>
                    </div>
                </div>

                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                        Grade
                    </button>
                    <div class="dropdown-menu">
                        <div class="form-group-sm">
                            <?php 
                            $gradeArr = [11,12];

                            foreach($gradeArr as $g){
                                echo '
                                <div class="form-check dropdown-item">
                                <label class="form-check-label dropdown-item">
                                <input type="checkbox" name="gradebox" class="form-check-input gradebox" value="'.$g.'" onchange="filterme()">'.$g.'
                                </label>
                                </div>';        
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                        Section
                    </button>
                    <div class="dropdown-menu" style=" height:150px !important;
          overflow-y:auto !important;">
                        <div class="form-group-sm" id="section_box">


                            <!-- <?php 
                            $res = mysqli_query($db, "SELECT DISTINCT section FROM manage_section");
                            if($res){
                                while($row = mysqli_fetch_assoc($res)){
                                    echo '
                                        <div class="form-check dropdown-item">
                                            <label class="form-check-label dropdown-item">
                                            <input type="checkbox" name="sectionbox" class="form-check-input" value="'.$s.'" onchange="filterme()">'.$s.'
                                            </label>
                                        </div>';    
                                }
                            }
                            ?> -->
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-secondary btnPrint">Print Data</button>
                </div>
                <br>
                <center>
                <input type="text" id="selectedtext" style="border: 0; font-size: 24px; font-weight: bold;">
                
                </input>
            
            </center>
                <hr>
                <div class="table-responsive">
                    <?php if($rtnReadVoters) { ?>
                        <div id="">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead class="">
                                <tr>
                                    <th>Student Number</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th class="noprint">Strand</th>
                                    <th class="noprint">Grade</th>
                                    <th class="noprint">Section</th>
                                    <th>Voters Code</th>
                                    <th class="noprint">Status</th>
                                    <th class="noprint">Edit</th>
                                    <th class="noprint">Delete</th>
                                </tr>
                            </thead>

                            <tbody class="myTable">
                                <?php while($rowVoter = $rtnReadVoters->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $rowVoter['student_number']; ?></td>
                                        <td><?php echo $rowVoter['last_name']; ?></td>
                                        <td><?php echo $rowVoter['first_name']; ?></td>
                                        <td><?php echo $rowVoter['middle_name']; ?></td>
                                        <td class="noprint"><?php echo $rowVoter['strand']; ?></td>
                                        <td class="noprint"><?php echo $rowVoter['grade']; ?></td>
                                        <td class="noprint"><?php echo $rowVoter['section']; ?></td>
                                        <td><?php echo $rowVoter['voters_code']; ?></td>
                                        <td class="noprint"><?php echo $rowVoter['status']; ?></td>
                                        <td class="noprint"><a href="/spccvotingsystem/comelec/edit_voter.php?id=<?php echo $rowVoter['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
                                        <td class="noprint"><a href="/spccvotingsystem/comelec/delete_voter.php?id=<?php echo $rowVoter['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                                    </tr>
                                <?php } //End while ?>
                            </tbody>
                        </table>
                    </div>
                        <?php $rtnReadVoters->free(); ?>
                    <?php } //End if ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddVoters">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Voter</h4><hr>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="zoom: 90%;">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                        <div class="form-group-sm">
                            <label for="student_number">Student Number</label>
                            <input required type="number" name="student_number" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            maxlength = "9">
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
                            <div class="form-group-sm col-md-4">
                                <label for="grade">Grade</label>
                                <select required name="grade" class="form-control" id="grade" >
                                    


                                    <option value="" disabled selected hidden>Select Grade</option>
                                    <?php 
                                    $grade = [11,12];
                                    foreach($grade as $g){
                                        echo '<option value="'.$g.'">'.$g.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group-sm col-md-4">
                                <label for="strand">Strand</label>
                                <select required name="strand" class="form-control" id="strand">
                                    <option value="" disabled selected hidden>Select Strand</option>
                                    <?php 
                                    $strand = ["ICT","STEM","H.E","ABM","HUMSS", "GAS"];
                                    foreach($strand as $s){
                                        echo '<option value="'.$s.'">'.$s.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group-sm col-md-4">
                                <label for="section">Section</label>
                                <select required name="section" class="form-control" id="section" disabled>
                                </select>
                            </div>
                        </div>
                        <label for="voters_code">Voters Code</label>
                        <div class="input-group">
                            <input name="voters_code" type="number" class="form-control" maxlength="20" onkeypress="return stringOnly(event)" id="showRandNum">
                            <div class="input-group-btn">
                                <button class="btn btn-outline-secondary" type="button" onclick="randomNumber()">
                                    Generate Voters Code
                                </button>
                            </div>
                        </div>

                        <div class="form-group-sm">
                            <label for="status">Status</label>
                            <select required name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>



                        <hr>
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

    <div class="modal fade" id="DeleteVoters">
        <div class="modal-dialog">
            <div class="modal-content border border-danger">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-danger">WARNING!</h4><hr>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <h5>You are about to Delete all Voters. All the data will be send to Archived Voters. Do you still want to delete all voters?</h5>

                    <p class="text-success">Deleted data will still recoverable.</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form method="POST" action="delete_all_voters.php" role="form">
                        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="MoveVoters">
        <div class="modal-dialog">
            <div class="modal-content border border-success">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-danger">CONFIRMATION</h4><hr>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p>Do you want to restore all data? </p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form method="POST" action="move_voters.php" role="form">
                        <input type="submit" name="submit" class="btn btn-success" value="Move Data">
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        var sym = "-";
        getSections();
        function randomNumber() {
            var x = document.getElementById("showRandNum")
            x.value = Math.floor((Math.random() * 1000000000) + 1);
        }

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
            var text = "";
            var strandbox = $('input:checkbox[name="strandbox"]:checked').map(function() {
            text+=$(this).val()+ ' - ';       
            return '^' + this.value + '\$';
        }).get().join('|');
            otable.fnFilter(strandbox, 4, true, false, false, false);

            var gradebox = $('input:checkbox[name="gradebox"]:checked').map(function() {         
            text+=$(this).val()+ ' - ';
            return '^' + this.value + '\$';      
        }).get().join('|');
          otable.fnFilter(gradebox, 5, true, false, false, false);

          var sectionbox = $('input:checkbox[name="sectionbox"]:checked').map(function() {
            text+=$(this).val()+ '';         
            return '^' + this.value + '\$';
        }).get().join('|');
          otable.fnFilter(sectionbox, 6, true, false, false, false);
          
          $('#selectedtext').val(text); // To display filtered checkbox
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
/*
    $(document).ready(function(){
        $('#displayText').multiselect({
            nonSelectedText: 'Show',
            enableFiltering:true,
            enableCaseInsensitiveFiltering:true,
            buttonWidth:'400px',
        });

    });
*/
    /* Old print
        $('.btnPrint').click(function(){
//          var x = document.querySelector(".myDIV");
  //        x.style.display = "none";

            var printme = document.getElementById('results');
            var wme = window.open("","","width=900,height=700");
            wme.document.write(printme.outerHTML);
                
            wme.document.close();
            wme.focus();
            wme.print();
            wme.close();
        });
        */
        $('.btnPrint').click(function(){
            var printme = document.getElementById('results');
            var wme = window.open(window.print());
            wme.document.write(printme.outerHTML);           
            wme.document.close();
            wme.focus();        
            wme.close();
        });
        
/*
$('.btnPrint').click(function(){
            var printme = document.getElementById('results');
            wme = window.print(printme);
            wme.document.write(printme.outerHTML);
            wme.close();    
        });
*/
</script>

</body>
</html>