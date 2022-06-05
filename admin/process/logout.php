<?php
//Start session
session_start();

session_destroy();
header("location: /spccvotingsystem/admin/index.php");
exit();