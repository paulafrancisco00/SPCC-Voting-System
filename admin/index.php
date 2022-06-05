<?php
//Start session
session_start();

unset($_SESSION['ADMIN_ID']);
unset($_SESSION['ADMIN_NAME']);
?>
<?php
include('../assets/tags.php');
 ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
   
    <link rel="stylesheet" href="../assets/css/style_admin.css">
</head>
<body>

<!-- Header -->
<!--

-->
<!-- End Header -->


<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="login-con">
                <center>
                <img src="../SPCCLogo.png" width="120">
                <br><br>
                <?php
                if(isset($_SESSION['ERROR_MSG_ARR']) && is_array($_SESSION['ERROR_MSG_ARR']) && count($_SESSION['ERROR_MSG_ARR']) > 0) {
                    foreach($_SESSION['ERROR_MSG_ARR'] as $msg) {
                        echo "<div class='alert alert-danger'>";
                        echo $msg;
                        echo "</div>";
                    }
                    unset($_SESSION['ERROR_MSG_ARR']);
                }
                ?>
                <h3>Administrator Log-in</h3><hr>
                 </center>
           
                <form method="post" action="process/login.php" role="form">
                    <div class="form-group has-feedback">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" autocomplete="off">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Login" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
           
        </div>
    </div>

</nav>
<!-- End Footer -->



</body>
</html>