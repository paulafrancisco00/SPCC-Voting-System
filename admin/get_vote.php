<?php
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

//Include class Position
require("classes/Position.php");

//Include class Nominees
require("classes/Nominees.php");

?>



<?php
    $candidateId = $_POST["candidateId"];
    
    global $db;

    $sql = "SELECT candidate_id
            FROM votes
            WHERE candidate_id = ?";
    if(!$stmt = $db->prepare($sql)) {
        echo $stmt->error;
    } else {
        $stmt->bind_param("i", $candidateId);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    $stmt->free_result();
    echo json_encode($result->num_rows, TRUE);
?>