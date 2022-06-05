<?php


class Grade
{
    public function INSERT_GRADE($grade) {
        global $db;

        //Check if the organization already exists in the database
        $sql = "SELECT *
                FROM manage_grade
                WHERE grade = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $grade);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the Grade you are trying to insert already exists in the database.</div>";
        } else {
            //Successfully inserted
            $sql = "INSERT INTO manage_grade(grade)VALUES(?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("s", $grade);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Grade was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        $result->free();
        return $stmt;
    }

    public function READ_GRADE() {
        global $db;

        $sql = "SELECT * FROM manage_grade";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }


    public function EDIT_GRADE($grade_id) {
        global $db;

        $sql = "SELECT *
                FROM manage_grade
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $grade_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_GRADE($grade, $grade_id) {
        global $db;

        $sql = "UPDATE manage_grade
                SET grade = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("si", $grade, $grade_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Update successful <a href='/spccvotingsystem/admin/add_grade.php'><span class='glyphicon glyphicon-backward'></span> </a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_GRADE($grade_id) {
        global $db;

        //Delete organization
        $sql = "DELETE FROM manage_grade
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $grade_id);
        }

        if($stmt->execute()) {
            header("location:add_grade.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }
}