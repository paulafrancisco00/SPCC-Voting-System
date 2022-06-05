<?php

class StudentLogin
{
    private $_student_number;
    private $_voters_code;
   
    public function __construct($c_student_number, $c_voters_code) {
        $this->_student_number = $c_student_number;
        $this->_voters_code = $c_voters_code;
    }

    public function StudLogin() {
        global $db;

        //Start session
        session_start();

        //Array to store error message
        $error_msg_array = array();

        //Error messages
        $error_msg = FALSE;

        if($this->_student_number == "") {
            $error_msg_array[] = "Please input your Student Number.";
            $error_msg = TRUE;
        }

        if($this->_voters_code == "") {
            $error_msg_array[] = "Please input your Voters Code.";
            $error_msg = TRUE;
        }

        if($error_msg) {
            $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
            header("location: /spccvotingsystem/index.php");
            exit();
        }

        $sql = "SELECT `status` FROM voters WHERE student_number = ? AND voters_code = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $this->_student_number, $this->_voters_code);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['status'] == 'active') {

                $sql = "SELECT * FROM voters WHERE student_number = ? AND voters_code = ? LIMIT 1";
                if(!$stmt = $db->prepare($sql)) {
                    echo $stmt->error;
                } else {
                    $stmt->bind_param("ss", $this->_student_number, $this->_voters_code);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }
                $row = $result->fetch_assoc();
                //Create session
                session_regenerate_id();
                $_SESSION['ID']      = $row['id'];
                $_SESSION['STUDENT_NUMBER'] = $row['student_number'];
                $_SESSION['LAST_NAME']    = $row['last_name'];
                $_SESSION['FIRST_NAME']    = $row['first_name'];
                $_SESSION['MIDDLE_NAME']    = $row['middle_name'];
                $_SESSION['STRAND']  = $row['strand'];
                $_SESSION['GRADE']    = $row['grade'];
                $_SESSION['SECTION']    = $row['section'];
                $_SESSION['VOTERS_CODE']    = $row['voters_code'];
                $_SESSION['STATUS']    = $row['status'];
                
                
                session_write_close();

                header("location:/spccvotingsystem/dummy-stud_page.php");

            } else {
                $error_msg_array[] = "Sorry, it seems you already voted.";
                $error_msg = TRUE;

                if($error_msg) {
                    $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
                    header("location: /spccvotingsystem/index.php");
                    exit();
                }
                $stmt->free_result();
            }

        } else {
            $error_msg_array[] = "The student number and voters code you entered is incorrect.";
            $error_msg = TRUE;

            if($error_msg) {
                $_SESSION['ERROR_MSG_ARRAY'] = $error_msg_array;
                header("location: /spccvotingsystem/index.php");
                exit();
            }
            $stmt->free_result();
        }
        $result->free();
        return $result;
    }
}




?>