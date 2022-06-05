    <?php
      global $db;

         $sql = "INSERT INTO archived_voters
                 SELECT * FROM voters";
            if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
          //  $stmt->bind_param("i", $voter_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;

    echo json_encode($result->num_rows, TRUE);
?>