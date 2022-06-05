<?php
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");


header("location:add_archived_voters.php");

    global $db;
    $sql = "INSERT INTO voters
            SELECT * FROM archived_voters;";
    $sql2 .= "DELETE FROM archived_voters;"; 

    if(!$stmt = $db->prepare($sql)) {
        echo $stmt->error;
    } else {
       // $stmt->bind_param("si", $status, $voter_id);
       if ($stmt->execute()){
         echo "<div class='alert alert-success'>All Voters were moved successfully.</div>";
       }
        $result = $stmt->get_result();
    }

    if(!$stmt = $db->prepare($sql2)) {
        echo $stmt->error;
    } else {
       // $stmt->bind_param("si", $status, $voter_id);
       if ($stmt->execute()){
         echo "<div class='alert alert-success'>All Voters were moved successfully.</div>";
       }
        $result = $stmt->get_result();
    }

    $stmt->free_result();
    //echo json_encode($result, TRUE);
?>


