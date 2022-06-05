<?php
//Include database connection
require("../config/db.php");

//Include class StudentLogin
require("../classes/StudentLogin.php");

if(isset($_POST['submit'])) {
	$student_number = trim($_POST['student_number']);
    $voters_code = trim($_POST['voters_code']);

    $loginStud = new StudentLogin($student_number, $voters_code);
    $rtnLogin = $loginStud->StudLogin();
}

$db->close();