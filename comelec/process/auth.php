<?php
//Create authentication

//Start session
session_start();

if(!isset($_SESSION['COMELEC_ID']) || $_SESSION['COMELEC_ID'] == 0) {
    header("location:../../comelec/index.php");
    exit();
}