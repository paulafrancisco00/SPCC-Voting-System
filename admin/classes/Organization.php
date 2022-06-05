<?php


class Organization
{
    public function INSERT_ORG($organization) {
        global $db;

        //Check if the organization already exists in the database
        $sql = "SELECT *
                FROM organization
                WHERE partylist = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $organization);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the Party List you are trying to insert already exists in the database.</div>";
        } else {
            //Successfully inserted
            $sql = "INSERT INTO organization(partylist)VALUES(?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("s", $organization);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Organization was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        $result->free();
        return $stmt;
    }

    public function READ_ORG() {
        global $db;

        $sql = "SELECT * FROM organization";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }


    public function EDIT_ORG($org_id) {
        global $db;

        $sql = "SELECT *
                FROM organization
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $org_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_ORG($partylist, $org_id) {
        global $db;

        $sql = "UPDATE organization
                SET partylist = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("si", $partylist, $org_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Update successful <a href='/spccvotingsystem/admin/add_org.php'> <button class='btn btn-outline-primary'>Back</button> </a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_ORG($org_id) {
        global $db;

        //Delete organization
        $sql = "DELETE FROM organization
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $org_id);
        }

        if($stmt->execute()) {
            header("location:add_org.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }
}