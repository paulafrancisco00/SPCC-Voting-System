<?php
//Start session
session_start();

session_destroy();
header("location:../../comelec/index.php");

exit();