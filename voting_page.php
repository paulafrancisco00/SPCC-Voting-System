<?php
//Include authentication
require("process/auth.php");

//Include database connection
require("config/db.php");

//Include class Voting
require("classes/Voting.php");
?>
<?php 
    include('assets/tags.php')
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    
</head>
<body>

    

<!-- Header -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="stud_page.php"><span class=""><img src="spcclogo.png" width="30"></span>&nbsp; SPCC Voting Sytem</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="stud_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="process/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>
<!-- End Header -->

<br>

<?php
if(isset($_GET['organization'])) {
    $org = $_GET['organization'];
}
?>

<?php

$readPos = new Voting();
$rtnReadPos = $readPos->READ_POSITION($org);

?>

<div class="container">
    <div class="row">
        <?php if($rtnReadPos) { ?>
        <div class="col-md-6 col-md-offset-3">
            <?php
            if(isset($_POST['vote'])) {
                $org            = trim($_POST['org']);
                $pos            = trim($_POST['pos']);
                $candidate_id   = trim($_POST['nominee']);
                $voters_id       = trim($_POST['voter_id']);
                $insertVote = new Voting();
                $rtnInsertVote = $insertVote->VOTE_NOMINEE($org, $pos, $candidate_id, $voters_id);
            }

            ?>



            <div class="voting-con">
              
                <h4 style="text-align: center;"><?php echo $org; ?> Voting Page</h4><hr />
                <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
                    <p class="help-block"><b><?php echo $rowPos['pos']; ?></b></p>
                        <?php
                        $readNominee = new Voting();
                        $rtnReadNominee = $readNominee->READ_NOMINEES($org, $rowPos['pos']);
                        ?>
                  
                        <?php if($rtnReadNominee) { ?>
                            <div class="form-group">
                                <select required name="nominee" class="form-control">
                                    <option value="">Select Nominee</option>
                                    <?php while($rowNominee = $rtnReadNominee->fetch_assoc()) { ?>
                                    <option value="<?php echo $rowNominee['id']; ?>">
                                        <?php echo 
                                        $rowNominee['last_name']. ', '.
                                        $rowNominee['first_name']. ' '. 
                                        $rowNominee['middle_name']; ?></option>
                                    <?php } //End while ?>
                                </select>
                            </div>
                        <?php } //End if ?>
                        <input  type="hidden" name="org" value="<?php echo $org; ?>">
                        <input type="hidden" name="pos" value="<?php echo $rowPos['pos']; ?>">
                        <input type="hidden" name="voter_id" value="<?php echo $_SESSION['ID']; ?>">



                    <?php
                    $validateVote = new Voting();
                    $rtnValVote = $validateVote->VALIDATE_VOTE($org, $rowPos['pos'], $_SESSION['ID'])
                    ?>
                    <button type="submit" name="vote"
                                <?php if($rtnValVote->num_rows > 0) { ?>

                                <?php echo 'class="btn btn-default disabled">'; ?>
                                <?php } else { ?>
                                <?php echo 'class="btn btn-info">'; ?>
                                <?php echo''; } //End if ?>
                            Vote
                        </button>

                </form>


                <hr />
                     

                <?php } //End while ?>
                   <a href="stud_page.php" style="float: right;"><button class="btn btn-primary">Back</button></a>
                   
                   <?php
            if(isset($_POST['update'])) {
                $student_number    = trim($_POST['student_number']);
                $last_name       = trim($_POST['last_name']);
                $first_name       = trim($_POST['first_name']);
                $middle_name       = trim($_POST['middle_name']);
                $strand     = trim($_POST['strand']);
                $grade     = trim($_POST['grade']);
                $section     = trim($_POST['section']);
                $voters_code    = trim($_POST['voters_code']);
                $status     = trim($_POST['status']);
                $updateVoter = new Voters();
                $rtnUpdateVoter = $updateVoter->UPDATE_VOTER($status);

            }
            ?>
<!--
            <?php
            if(isset($_GET['id'])) {
                $id = trim($_GET['id']);

                $editVoter = new Voters();
                $rtnEditVoter = $editVoter->EDIT_VOTER($id);
            }
            ?>
--> 

                
                    <input type="hidden" name="voterId" id="voterId" value="<?php echo $_SESSION['ID']; ?>">
                    <input type="hidden" name="status" id="status" value="inactive">
                    <button type="button" class="btn btn-info" id="btnSubmit">Finalize Vote</button> 
                
            </div>
        </div>
        <?php } //End if ?>
    </div>
</div>

<script>
    $(function(){
        $('#btnSubmit').on('click', function(e){
            e.preventDefault();
            var postData = {
                'voterId': $('#voterId').val(),
                'status': $('#status').val() 
            }
            $.ajax({
                type: 'POST',
                data: postData,
                url: 'update_status.php',
                dataType: 'JSON',
                success: function(data) {
                    window.location.href = 'index.php';
                   
                },
                error: function(xhr, ajaxFunction, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });

        });
    });



    
</script>
</body>
</html>