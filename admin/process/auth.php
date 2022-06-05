<?php
//Create authentication

//Start session
session_start();

if(!isset($_SESSION['ADMIN_ID']) || $_SESSION['ADMIN_ID'] == 0) {
    header("location: /spccvotingsystem/admin/index.php");
    exit();
}