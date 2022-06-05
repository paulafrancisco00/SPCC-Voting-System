<?php
//Start session
session_start();

unset($_SESSION['ID']);
unset($_SESSION['STUDENT_NUMBER']);
unset($_SESSION['LAST_NAME']);
unset($_SESSION['FIRST_NAME']);
unset($_SESSION['MIDDLE_NAME']);
unset($_SESSION['STRAND']);
unset($_SESSION['GRADE']);
unset($_SESSION['SECTION']);
unset($_SESSION['VOTERS_CODE']);
 require "config/db.php";

if(!isset($_SESSION['stat']) || $_SESSION['stat'] == 0){
    header("Location:closed.php");
}
$page = $_SERVER['PHP_SELF'];
$sec = "";

?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page ?>'">
    <title>SPCC Voting Management System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="assets/css/bootstrap-grid.css">
<link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="assets/css/style_voter.css">
</head>
<body>

<!-- Header 
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
     
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SPCC Management Voting Sytem</a>
        </div>

    </div>
</nav>
End Header -->




<div class="open">
<div class="container" style="zoom: 90%;">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="login-con">
                <center>
                <img src="SPCCLogo.png" width="120">
                <br><br>
                <h3>SPCC Student Log In Portal</h3><hr>
                 </center>
                <?php
                if(isset($_SESSION['ERROR_MSG_ARRAY']) && is_array($_SESSION['ERROR_MSG_ARRAY']) && COUNT($_SESSION['ERROR_MSG_ARRAY']) > 0) {
                    foreach($_SESSION['ERROR_MSG_ARRAY'] as $msg) {
                        echo "<div class='alert alert-danger'>";
                        echo $msg;
                        echo "</div>";
                    }
                    unset($_SESSION['ERROR_MSG_ARRAY']);
                }
                ?>
                   
                <form method="post" action="process/login.php" role="form">
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input type="number" name="student_number" id="student_number" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="voters_code">Voters Code</label>
                        <input type="password" name="voters_code" id="voters_code" class="form-control" autocomplete="off">
                    </div>
                    
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                        <br><br>
                </form>     

            </div>
         </div>
    </div>
</div>






<!-- Footer -->
<nav class="navbar navbar-light bg-light" role="navigation">

    <div class="container">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <center>
           <p>Welcome to our SPCC Student Log In Portal. 
            <br>
             
            Your Participation in the election is critical and will be kept Confidential. To access your account, Please Enter the <b>Voters Code</b> you were given by the Administrator.</p>
            <button type="button" class="btn btn-outline-primary" data-dismiss="alert" aria-label="close">Close</button>
        </center>
        </div>
    </div>

    

</nav>
</div>


<!-- <div class="closed">
<div class="container" style="zoom: 110%;">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5"><center>
            <img src="SPCCLogo.png" width="120">
       <br>
        <br>
           <div class="alert alert-danger alert-dismissible">
  <strong>Sorry we're now closed.</strong> 
  <br>Early voting will resume tomorrow at 6:00am - 5:00pm
</div>
 </center>

    </div>
</div>

</div>
</div> -->
<!-- End Footer -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>


<!-- <script>
    /*
   window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
*/
    //gets the current time. 
var d = new Date();
if(d.getHours() >= 6 && d.getHours() <= 17 ){
    /* 6am - 5pm (24-hour format) */
    $(".open").show();
    $(".closed").hide();
}
else {  
     $(".closed").show();
    $(".open").hide();
}

</script> -->
</body>
</html> 