<?php


class Nominees
{

    public function INSERT_NOMINEE($img, $partylist, $pos, $last_name, $first_name, $middle_name, $strand, 
        $grade, $student_number) {
        global $db;

        //Check to see if the nominee already exists in the database.
        $sql = "SELECT *
                FROM nominees
                WHERE partylist = ? 
                AND pos = ?
                || student_number = ?
                LIMIT 1";

        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("sss", $partylist, $pos, $student_number);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the party list, position or student number you entered already exist in the database</div>";
        } else {
            //Insert nominee
            $sql = "INSERT INTO nominees(img, partylist, pos, last_name, first_name, middle_name, strand, grade, student_number)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("sssssssss", $img, $partylist, $pos, $last_name, $first_name, $middle_name, $strand, $grade, $student_number);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Nominee was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    

    public function READ_NOMINEE() {
        global $db;

        $sql = "SELECT *
                FROM nominees
                ORDER BY ID ASC";

        // $sql = "
        // SELECT 
        //     a.id, a.pos, a.partylist,  
        // FROM 
        //     nominees a
        // INNER JOIN organization b ON a.partylist = b.partylist"
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }


    public function EDIT_NOMINEE($nom_id) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $nom_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_NOMINEE($img, $partylist, $pos, $last_name, $first_name, $middle_name, $strand, 
        $grade, $student_number, $nom_id) {
        global $db;
        $sql = "UPDATE nominees SET img = ?, partylist = ?, pos = ?, last_name = ?, first_name =?, middle_name = ?, strand = ?, grade = ?, student_number = ? WHERE id = ? LIMIT 1";

        $sql2 = "UPDATE nominees SET partylist = ?, pos = ?, last_name = ?, first_name =?, middle_name = ?, strand = ?, grade = ?, student_number = ? WHERE id = ? LIMIT 1";
       

    if(!empty($img)){
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("sssssssssi", $img, $partylist, $pos,  $last_name, $first_name, $middle_name, $strand, $grade, $student_number, $nom_id);
        }
    }
    else{
          if(!$stmt = $db->prepare($sql2)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssssssssi",  $partylist, $pos,  $last_name, $first_name, $middle_name, $strand, $grade, $student_number, $nom_id);
        }
    }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Update successful <a href='/spccvotingsystem/admin/add_nominees.php'><button class='btn btn-outline-primary'>Back</button> </a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_NOMINEE($nom_id) {
        global $db;

        $sql = "DELETE FROM nominees
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $nom_id);
        }
        if($stmt->execute()) {
            header("location: /spccvotingsystem/admin/add_nominees.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

    public function READ_NOM_BY_ORG_POS($partylist, $pos) {
        global $db;

        $sql = '';

        if ($partylist == "ALL") {
            $sql = "SELECT *
                FROM nominees
                WHERE nominees.pos = ? ";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("s", $pos);
                $stmt->execute();
                $result = $stmt->get_result();
            }
            $stmt->free_result();
            return $result;
        } else {
            $sql = "SELECT *
                FROM nominees
                WHERE nominees.partylist = ?
                AND nominees.pos = ? ";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ss", $partylist, $pos);
                $stmt->execute();
                $result = $stmt->get_result();
            }
            $stmt->free_result();
            return $result;
        }

        
            
    }




    public function COUNT_VOTES($candidate_id) {
        global $db;

        $sql = "SELECT COUNT(candidate_id)
                FROM votes
                WHERE candidate_id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $candidate_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }
}