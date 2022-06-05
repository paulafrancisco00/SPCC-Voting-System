<?php
//Include database connection
require("../../config/db.php");

//Include class Comelec_Login
require("../classes/Comelec_Login.php");

if(isset($_POST['submit'])) {

    //Create variable to store post array values
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $adminLogin = new Comelec_Login($username, $password);
    $rtnAdminLogin = $adminLogin->ComelecLogin();

}
