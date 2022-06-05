<?php
//Include authentication
require("process/auth.php");

//Include database connection
require("config/db.php");

//Include class Voting
require("classes/Voting.php");

//Include class Organization
require("admin/classes/Organization.php");

//Include class Position
require("admin/classes/Position.php");

//Include class Nominees
require("admin/classes/Nominees.php");


?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="assets/css/style_voter.css">
    <link rel="stylesheet" href="assets/css/zoom.css">
    
    <style>
  
  .card-deck {
    display: grid;
    
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: .5rem;
}
.nav .flex-column {
  background: red !important;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  background: #182560;
}

.nav-link.active:hover {
  background: #182590;
}

.nav>li>a:hover {
  background: #182535;
  color: white !important;
}

.imgDesign {
    width: 150px;
    height: 150px;
}







</style>

</head>
<body>


<?php
$readOrganization = new Voting();
$rtnReadOrg = $readOrganization->READ_ORG();
?>

<div class="container" style="border: solid 1px #003399; border-radius: 10px;">
    <div class="row">
        <div class="column col-md-12">

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
            <?php
            if(isset($_POST['vote'])) {

               
                foreach ($_POST['candidate'] as $key => $candidate) {

                    $read_nominee = new Nominees();
                    $res = $read_nominee->READ_NOMINEE();

                    //nominee loop
                    foreach ($res as $verify) {
                        // if nominee matched from table
                        if ($verify['id'] == $candidate) {

                            // required data for insert
                            $org            = trim($verify['partylist']);
                            $pos            = trim($verify['pos']);
                            $candidate_id   = trim($verify['id']);
                            $voters_id      = trim($_POST['voter_id']);

                            $insertVote = new Voting();
                            $rtnInsertVote = $insertVote->VOTE_NOMINEE($org, $pos, $candidate_id, $voters_id);
                        }
                    }

                    //set voter to inactive

                    require('update_status.php');

                    header('Location:votesuccess.php');
                }
                /*=====  End of Voting Process  ======*/


                // $org            = trim($arr_org);
                // $pos            = trim($arr_pos);
                // $candidate_id   = trim($arr_candidate_id);
                // $voters_id       = trim($_POST['voter_id']);

                // var_dump($org);


                // $insertVote = new Voting();
                // $rtnInsertVote = $insertVote->VOTE_NOMINEE($org, $pos, $candidate_id, $voters_id);
            }

            ?>

            <br>
            <center>
            <img src="SPCCLogo.png" width="120">
        
        <br><br>
            <h4>Welcome, 
                <?php echo $_SESSION['FIRST_NAME'].' '.
                           $_SESSION['MIDDLE_NAME'].' '.
                           $_SESSION['LAST_NAME']; 
                ?>!
            </h4>
            </center>
            <hr>
        <?php
        $readNominees = new Nominees();
        $rtnReadNominees = $readNominees->READ_NOMINEE();
        ?>
                   
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">

                        <center>
                            <h4>Choose Your Nominee</h4>

		<nav class="navbar navbar-fixed-bottom" role="navigation">
		
    		<div class="container">
      	 	 <div class="navbar-text pull-right">
    	         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">How to Vote?</button>

     	   	</div>
   	 	</div>
	
		</nav>

                        </center>
                        <div class="form-group">
                
                <table class="table table-condensed ">
                <?php if($rtnReadNominees) { ?>

                    <?php 
                    $arr = array();
                    $cpos ="";
                    $nrow = false;
                    while($rowNom = $rtnReadNominees->fetch_assoc()) { 
                        if($cpos != $rowNom['pos']){
                            $cpos = $rowNom['pos'];
                            $nrow = true;
                            echo "<tr >";
                        }
                        ?>
                            
                            <td>

                         <h4 class="card-title text-center">
                            <?php echo
                          $rowNom['pos']. ' - '. 
                                        $rowNom['partylist']; ?></h4>
                        <?php echo "<img class='imgDesign' src='admin/images/".$rowNom['img']."'"; ?>

                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input required type="radio" name="candidate[<?php echo $rowNom['pos']; ?>]" value="<?php echo $rowNom['id']; ?>">

                                <?php echo $rowNom['last_name'] . ", " . $rowNom['first_name'] . " " . $rowNom['middle_name']; ?>

                                <!-- <input type="hidden" name="org" value="<?php echo $rowNom['partylist']; ?>"> -->
                                <!-- <input type="hidden" name="pos" value="<?php echo $rowNom['pos']; ?>"> -->

                                <?php array_push($arr, $rowNom['pos']); ?>
                            </label>
                        </td>
                        <?php
                        if(!$nrow){
                            echo "</tr>";
                        }
                        ?>

            </form>
                    <?php } //End while ?>
                    <?php $rtnReadNominees->free(); ?>
                <?php } //end if ?>
            </table>

                   <br>
                        <input type="hidden" name="voter_id" id="voter_id" value="<?php echo $_SESSION['ID']; ?>">

             <!--           <?php var_dump($arr); ?> -->
                      <input type="hidden" name="status" id="status" value="inactive">
           

                        <center><button type="submit" name="vote" class="btn btn-primary" id="btnSubmit" 
                        onclick="return confirm('Are you sure, you want to finalize your vote?');">Submit</button></center>
                </form>
                <br>
                



      





<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h3 style="color:blue;">HOW TO VOTE?</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h4><b style="color:green;">STEP 1: </b>Click ONE candidate each position.</h4>
          <h4><b style="color:green;">STEP 2: </b>Review your vote.</h4>
          <h4><b style="color:green;">STEP 3: </b>Click VOTE button if you're done voting.</h4>
          <br>
          <h4><b style="color:red;">REMINDER: </b>Once you start voting, you must submit and finish your votes in order to validate and count your vote.</h4>
          
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Footer -->



<!-- End Footer -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/zoom.js"></script>


<script>

    $(function(){

       $('#btnSubmit').on('submit', function(e){
        if(confirm("Are you sure you want to delete this?")){
            e.preventDefault();

             }
              else{
        return false;
    }
            // var postData = {
            //     'voter_id': $('#voter_id').val(),
            //     'status': $('#status').val() 
            // }


            // $.ajax({
            //     type: 'POST',
            //     data: postData,
            //     url: 'update_status.php',
            //     dataType: 'JSON',
            //     success: function(data)
            // });
        });
    });
</script>

<script>

</script>
</body>
</html>