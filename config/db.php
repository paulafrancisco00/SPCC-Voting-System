<?php

//This line of code connects to mysql database
define("HOST_NAME", "localhost");
define("HOST_USER", "root");
define("HOST_PASS", "");
define("HOST_DB", "voting");

$db = new mysqli(HOST_NAME, HOST_USER, HOST_PASS, HOST_DB);

$chksql = "select * from votingpage where status='ACTIVE'";
$chkres = mysqli_query($db,$chksql);
$chkrec = mysqli_fetch_assoc($chkres);
$_SESSION['stat'] = $chkrec['voting'];


/**
 * This line of code checks if connection error exists.

if($db->connect_error) {
    echo $db->connect_errno . " " . $db->connect_error;
} else {
    echo "Connection successful.";
}
 */