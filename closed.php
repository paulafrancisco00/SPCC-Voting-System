<?php
session_start();
require "config/db.php";
if($_SESSION['stat'] == 1){
	header("LOCATION:index.php");
}

$page = $_SERVER['PHP_SELF'];
$sec = "10"
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page ?>'">
</head>
<body>

<fieldset class="container" style="border-color:#007bff !important; ">
	
<center>

	 <div class="card-body">
        <img src="SPCCLogo.png" width="100"><br><br>
    </div>
	<h1>Sorry the Voting System is now officially <u style="color:red;">[CLOSED]</u></h1>
</center>
</fieldset>

</body>
</html>