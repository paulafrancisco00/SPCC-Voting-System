<?php
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");


header("location:add_archived_voters.php");

    global $db;
    $sql = "DELETE FROM archived_voters";
  

    if(!$stmt = $db->prepare($sql)) {
        echo $stmt->error;
    } else {
       // $stmt->bind_param("si", $status, $voter_id);
       if ($stmt->execute()){
         echo "<div class='alert alert-success'>All Archived Voters were deleted successfully.</div>";
       }
        $result = $stmt->get_result();
    }

 

    $stmt->free_result();
    //echo json_encode($result, TRUE);
?>


