<?php


class Position
{
    public function INSERT_POS($partylist, $pos) {
        global $db;

        //Check to see if the position is already inserted
        $sql = "SELECT *
                FROM positions
                WHERE partylist = ?
                AND pos = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $partylist, $pos);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the position you entered is already inserted in the database.</div>";
        } else {
            //Insert position in the database
            $sql = "INSERT INTO positions(partylist, pos)VALUES(?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("ss", $partylist, $pos);
            }
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Position was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_POS() {
        global $db;

        //Read positions in every organization
        $sql = "SELECT *
                FROM positions
                ORDER BY id ASC GROUP BY positions";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function READ_OLD_POS() {
        global $db;

        //Read positions in every organization
        $sql = "SELECT *
                FROM positions
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

    public function EDIT_POS($pos_id) {
        global $db;

        //Edit position
        $sql = "SELECT *
                FROM positions
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $pos_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_POS($partylist, $pos, $pos_id) {
        global $db;

        //Update position
        $sql = "UPDATE positions
                SET partylist = ?, pos = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $partylist, $pos, $pos_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Position was updated successfully.<a href='/spccvotingsystem/admin/add_pos.php'> <button class='btn btn-outline-primary'>Back</button></a></div>";
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
    public function DELETE_POS($pos_id) {
        global $db;

        //Read positions in every organization
        $sql = "DELETE FROM positions
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $pos_id);
        }

        if($stmt->execute()) {
            header("location:/spccvotingsystem/admin/add_pos.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

    public function READ_POS_BY_ORG($partylist) {
        global $db;

        if ($partylist == "ALL") {
            $sql = "SELECT *
                FROM positions";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                // $stmt->bind_param("s", $partylist);
                $stmt->execute();
                $result = $stmt->get_result();
            }
            $stmt->free_result();
            return $result;
        } else {
            $sql = "SELECT *
                FROM positions
                WHERE partylist = ?";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("s", $partylist);
                $stmt->execute();
                $result = $stmt->get_result();
            }
            $stmt->free_result();
            return $result;
        }

        
    }
}