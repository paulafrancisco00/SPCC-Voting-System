<?php
//Create authentication

//Start session
session_start();

if(!isset($_SESSION['STUDENT_NUMBER']) AND ($_SESSION['VOTERS_CODE']) == 0) {
    header("location: /spccvotingsystem/index.php");
    exit();
}