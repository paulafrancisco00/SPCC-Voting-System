<?php

class Voters
{
    public function INSERT_VOTER($student_number,$last_name, $first_name, $middle_name, $section_id, $voters_code, $status) {
        global $db;

        //Check to see if the voter exists
        $sql = "SELECT *
                FROM voters
                WHERE last_name = ? 
                AND first_name = ?
                AND middle_name = ?
                || student_number = ?
                || voters_code = ?
                LIMIT 1";

        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("sssss", $last_name, $first_name, $middle_name, $student_number, $voters_code);
            $stmt->execute();
            $result = $stmt->get_result();
        }        

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry the voter or student number you entered already exists in the database.</div>";
        } else {
            //Insert voter
            $sql = "INSERT INTO voters(student_number, last_name, first_name, middle_name, section_id, voters_code, status)VALUES(?, ?, ?, ?, ?, ?, ?)";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } else {
                $stmt->bind_param("sssssss", $student_number, $last_name, $first_name, $middle_name, $section_id, $voters_code, $status);
            }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Voter was inserted successfully.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

    public function READ_VOTERS() {
        global $db;

        $sql = "SELECT v.id, v.student_number, v.last_name, v.first_name, v.middle_name,ms.grade, ms.strand, ms.section, v.voters_code, v.status 
            FROM voters v, manage_section ms 
            WHERE ms.id = v.section_id ORDER BY v.id DESC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function READ_ARCHIVED_VOTERS() {
        global $db;

      $sql = "SELECT v.id, v.student_number, v.last_name, v.first_name, v.middle_name,ms.grade, ms.strand, ms.section, v.voters_code, v.status 
            FROM archived_voters v, manage_section ms 
            WHERE ms.id = v.section_id ORDER BY v.id DESC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }



    public function EDIT_VOTER($voter_id) {
        global $db;

        $sql = "SELECT v.id, v.student_number, v.last_name, v.first_name, v.middle_name, v.section_id, ms.grade, ms.strand, ms.section, v.voters_code, v.status 
            FROM voters v, manage_section ms 
            WHERE v.section_id = ms.id AND v.id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $voter_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_VOTER($student_number, $last_name, $first_name, $middle_name, $section_id, $voters_code, $status, $voter_id) {
        global $db;

        $sql = "UPDATE voters
                SET student_number = ?, 
                last_name = ?, first_name = ?, middle_name = ?,
                section_id = ?, voters_code = ?, status = ?
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("sssssssi", $student_number, $last_name, $first_name, $middle_name, $section_id, $voters_code, $status, $voter_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Voter was updated successfully.<a href='/spccvotingsystem/admin/add_voters.php'> <button class='btn btn-outline-primary'>Back</button></a></div>";
        }else{
            echo $stmt->error;
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_VOTER($voter_id) {
        global $db;

        $sql = "SELECT * FROM voters WHERE id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $voter_id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                $stmt->free_result();
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $student_number = $row['student_number'];
                $last_name = $row['last_name'];
                $first_name = $row['first_name'];
                $middle_name = $row['middle_name'];
                $section_id = $row['section_id'];
                $voters_code = $row['voters_code'];
                $status = $row['status'];
                $archive = $db->query("INSERT INTO archived_voters(id,student_number,last_name,first_name,middle_name,section_id,voters_code,status) 
                    VALUES ('$id','$student_number','$last_name','$first_name','$middle_name','$section_id','$voters_code','$status')");
                if($archive){
                    $delete = $db->query("DELETE FROM voters WHERE id = '$voter_id'");
                    if($delete){
                        header("location:add_voters.php");
                        exit();
                    }else{
                        echo $db->error;
                    }
                }else{
                    echo $db->error;
                }
            }
        }
    }
 
  
}