<?php

?>

<?php
$message = 'This is a message.';
header("location:index.php");


    $voter_id = $_POST['voter_id'];
    $status = $_POST['status'];
    global $db;

    $sql = "UPDATE voters
            SET status = ?
            WHERE id = ? LIMIT 1";
    if(!$stmt = $db->prepare($sql)) {
        echo $stmt->error;
    } else {
        $stmt->bind_param("si", $status, $voter_id);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    $stmt->free_result();
    echo json_encode($result, TRUE);
?>




