<?php


class Section
{
    public function INSERT_SECTION($grade, $strand, $section) {
        global $db;

        //Check to see if the position is already inserted
        $sql = "SELECT *
                FROM manage_section
                WHERE grade = ?
                AND strand = ?
                AND section = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("sss", $grade, $strand, $section);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the section you entered is already inserted in the database.</div>";
        } else {
            //Insert position in the database
            $sql = "INSERT INTO manage_section(grade, strand, section)VALUES(?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("sss", $grade, $strand, $section);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Section was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_SECTION() {
        global $db;

        //Read positions in every organization
        $sql = "SELECT *
                FROM manage_section
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

    public function EDIT_SECTION($section_id) {
        global $db;

        //Edit position
        $sql = "SELECT *
                FROM manage_section
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $section_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_SECTION($grade, $strand, $section, $section_id) {
        global $db;

        //Update position
        $sql = "UPDATE manage_section
                SET grade = ?, strand = ?, section = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("sssi", $grade, $strand, $section, $section_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Section was updated successfully. <a href='/spccvotingsystem/admin/add_section.php'><button class='btn btn-outline-primary'>Back</button></a></div>";
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
    public function DELETE_SECTION($section_id) {
        global $db;

        //Read positions in every organization
        $sql = "DELETE FROM manage_section
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $section_id);
        }

        if($stmt->execute()) {
            header("location:/spccvotingsystem/admin/add_section.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

 
}