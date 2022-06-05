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
    <title>Administrator Login</title>

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
                    $section_id     = trim($_POST['grade_strand_section']);
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
                    <h4 style="display: inline;">List of Voters</h4>
                    <br>
                    <br>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#AddVoters">Add New Voter</button>

                    <button class="btn btn-warning" data-toggle="modal" data-target="#moveVoters">Restore Data</button>

                    <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteVoters">Delete All Voters</button>
                </center>
                <br>
                <!-- <input class="form-control myInput" style="float: right; width: 30%;"  placeholder="Search..."> -->



                <?php
                $readOrg = new Grade();
                $rtnReadGrade = $readOrg->READ_GRADE();
                ?>   
                <label>Filter By: </label>&nbsp;


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
                        Strand
                    </button>
                    <div class="dropdown-menu">
                        <div class="form-group-sm">
                            <?php 
                                $strandArr = ["ICT","STEM","H.E.","ABM","HUMSS"];

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
                        Section
                    </button>
                    <div class="dropdown-menu">
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
                <hr>
                <div class="table-responsive">
                    <?php if($rtnReadVoters) { ?>
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Grade</th>
                                    <th>Strand</th>
                                    <th>Section</th>
                                    <th>Voters Code</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody class="myTable">
                                <?php while($rowVoter = $rtnReadVoters->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $rowVoter['student_number']; ?></td>
                                        <td><?php echo $rowVoter['last_name']; ?></td>
                                        <td><?php echo $rowVoter['first_name']; ?></td>
                                        <td><?php echo $rowVoter['middle_name']; ?></td>
                                        <td><?php echo $rowVoter['grade']; ?></td>
                                        <td><?php echo $rowVoter['strand']; ?></td>
                                        <td><?php echo $rowVoter['section']; ?></td>
                                        <td><?php echo $rowVoter['voters_code']; ?></td>
                                        <td><?php echo $rowVoter['status']; ?></td>
                                        <td><a href="/spccvotingsystem/admin/edit_voter.php?id=<?php echo $rowVoter['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
                                        <td><a href="/spccvotingsystem/admin/delete_voter.php?id=<?php echo $rowVoter['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                                    </tr>
                                <?php } //End while ?>
                            </tbody>
                        </table>
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
                        <div class="form-group-sm">
                            <label for="grade_strand_section">Grade - Strand - Section</label>
                            <select required name="grade_strand_section" class="form-control" id="grade_strand_section">
                                <option value="" disabled selected hidden>Select Grade - Strand - Section</option>
                                <?php 
                                $sql = "SELECT * FROM manage_section ORDER BY grade ASC";

                                if(!$stmt = $db->prepare($sql)) {
                                    echo $stmt->error;
                                } else {
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                }
                                $stmt->free_result();
                                foreach($result as $res){
                                    echo '<option value="'.$res['id'].'">'.$res['grade'].' - '.$res['strand'].' - '.$res['section'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group-sm col-md-4">
                                <label for="grade">Grade</label>
                                <input type="grade" disabled class="form-control" id="grade">
                            </div>

                            <div class="form-group-sm col-md-4">
                                <label for="strand">Strand</label>
                                <input type="strand" disabled class="form-control" id="strand">
                            </div>

                            <div class="form-group-sm col-md-4">
                                <label for="section">Section</label>
                                <input type="section" disabled class="form-control" id="section">
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
                                <option value="inactive" disabled>Inactive</option>
                            </select>
                        </div>



                        <hr>
                        <div class="form-group-sm">
                            <input type="submit" name="submit" value="Submit" class="btn btn-info">
                        </div>


                    </form>

                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
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

                    <h5>You are about to Delete all Voters. This process cannot be undone. Do you still want to delete all voters?</h5>

                    <p class="text-danger">Deleted data will not be recoverable.</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form method="POST" action="delete_all_voters.php" role="form">
                        <input type="submit" name="submit" class="btn btn-danger" value="Permanent Delete">
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="moveVoters">
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

    </script>

</body>
</html>