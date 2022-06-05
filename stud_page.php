<?php
//Include authentication
require("process/auth.php");

//Include database connection
require("config/db.php");

//Include class Voting
require("classes/Voting.php");
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
            <a class="navbar-brand" href="stud_page.php"><span class="glyphicon glyphicon-home"></span> Voting Sytem</a>
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




<?php
$readOrganization = new Voting();
$rtnReadOrg = $readOrganization->READ_ORG();
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3 style="text-align: center;">Select Organization</h3><hr />
            <h4>Welcome, <?php echo $_SESSION['FIRST_NAME'].' '.
                                    $_SESSION['MIDDLE_NAME'].' '.
                                    $_SESSION['LAST_NAME']
                                    ; ?>!</h4>

            <?php if($rtnReadOrg) 
             { ?>
            <form action="voting_page.php" method="GET" role="form">
                <div class="form-group">
                    <label for="organization">Organization</label>
                    <select required class="form-control" name="organization">
                        <option value="">Select Organization</option>
                        <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                        <option value="<?php echo $rowOrg['partylist']; ?>"><?php echo $rowOrg['partylist']; ?></option>
                        <?php } //End while ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Vote" class="btn btn-info">
                </div>
            </form>
                <?php $rtnReadOrg->free(); ?>
            <?php } //End if ?>
        </div>
    </div>
</div>





<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title text-center">HOW TO VOTE?</h3>
        </div>
        <div class="modal-body">
          <h4><b>STEP 1: </b>Click ONE candidate each position.</h4>
          <h4><b>STEP 2: </b>Review your vote.</h4>
          <h4><b>STEP 3: </b>Click VOTE button if you're done voting.</h4>
          <br>
          <h4><b>REMINDER: </b>Once you start voting, you must submit and finish your votes in order to validate and count your vote.</h4>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Footer -->
<nav class="navbar navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-right">
             <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#myModal">How to Vote?</button>

        </div>
    </div>

</nav>
<!-- End Footer -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>


</body>
</html>