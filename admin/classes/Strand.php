<?php


class Strand
{
    public function INSERT_STRAND($grade, $strand) {
        global $db;

        //Check to see if the position is already inserted
        $sql = "SELECT *
                FROM manage_strand
                WHERE grade = ?
                AND strand = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $grade, $strand);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the grade you entered is already inserted in the database.</div>";
        } else {
            //Insert position in the database
            $sql = "INSERT INTO manage_strand(grade, strand)VALUES(?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ss", $grade, $strand);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Position was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_STRAND() {
        global $db;

        //Read positions in every organization
        $sql = "SELECT *
                FROM manage_strand
                ORDER BY id ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function EDIT_STRAND($strand_id) {
        global $db;

        //Edit position
        $sql = "SELECT *
                FROM manage_strand
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $strand_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_STRAND($grade, $strand, $strand_id) {
        global $db;

        //Update position
        $sql = "UPDATE manage_strand
                SET grade = ?, strand = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $grade, $strand, $strand_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Strand was updated successfully. <a href='/spccvotingsystem/admin/add_strand.php'> <button class='btn btn-outline-primary'>Back</button></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }
/*
    public function UPDATE_POS($status) {
        global $db;

        //Update position
        $sql = "UPDATE votingpage
                SET status = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $status);
        }

        if($stmt->execute()) {
            header('');
            echo "<div class='alert alert-success'>Voting Page was updated successfully.<a href='/spccvotingsystem/admin/add_pos.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }
    
*/
    public function DELETE_STRAND($strand_id) {
        global $db;

        //Read positions in every organization
        $sql = "DELETE FROM manage_strand
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $strand_id);
        }

        if($stmt->execute()) {
            header("location:/spccvotingsystem/admin/add_strand.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

 
}