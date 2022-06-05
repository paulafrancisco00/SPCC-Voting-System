<?php
require("../process/auth.php");

//Include database connection
require("../../config/db.php");

if(isset($_POST['key'])){
    if($_POST['key'] == 'get_sections'){
        if(!empty($_POST['grade']) && !empty($_POST['strand'])){
            $grade = $_POST['grade'];    
            $gradeArr = [];
            foreach($grade as $g){
                array_push($gradeArr,$g);
            }
            $gradeArr = implode(",", $gradeArr);

            $strand = $_POST['strand'];    
            $strandArr = [];
            foreach($strand as $s){
                array_push($strandArr,$s);
            }
            $strandArr = implode(",", $strandArr);

            $sql = $db->query("SELECT section FROM manage_section WHERE grade IN ($gradeArr) AND strand IN ('$strandArr')");
        }else if(!empty($_POST['grade'])){
            $grade = $_POST['grade'];    
            $gradeArr = [];
            foreach($grade as $g){
                array_push($gradeArr,$g);
            }
            $gradeArr = implode(",", $gradeArr);

            $sql = $db->query("SELECT section FROM manage_section WHERE grade IN ($gradeArr)");
        }else if(!empty($_POST['strand'])){
            $strand = $_POST['strand'];    
            $strandArr = [];
            foreach($strand as $s){
                array_push($strandArr,$s);
            }
            $strandArr = implode(",", $strandArr);

            $sql = $db->query("SELECT section FROM manage_section WHERE strand IN ('$strandArr')");
        }else{
            $sql = $db->query("SELECT section FROM manage_section");
        }

        if($sql->num_rows>0){
            while($row = $sql->fetch_assoc()){
                echo '
                <div class="form-check dropdown-item">
                <label class="form-check-label dropdown-item">
                <input type="checkbox" name="sectionbox" class="form-check-input sectionbox" value="'.$row['section'].'" onchange="filterme()">'.$row['section'].'
                </label>
                </div>';
            }
        }else{
            echo $db->error;
        }
    }

    if($_POST['key'] == 'sections'){
        if(!empty($_POST['grade']) && !empty($_POST['strand'])){
            $grade = $_POST['grade'];
            $strand = $_POST['strand'];
            $sql = $db->query("SELECT id,section FROM manage_section WHERE grade = $grade AND strand = '$strand'");
        }else if(!empty($_POST['grade'])){
            $grade = $_POST['grade'];    
            $sql = $db->query("SELECT id,section FROM manage_section WHERE grade = $grade");
        }else if(!empty($_POST['strand'])){
            $strand = $_POST['strand'];    
            $sql = $db->query("SELECT id,section FROM manage_section WHERE strand = '$strand'");
        }

        $section = "";
        if(!empty($_POST['section'])){
            $section = $_POST['section'];
        }
        
        if($sql->num_rows>0){
            $data = '<option value="" disabled selected hidden>Select Section</option>';
            while($row = $sql->fetch_assoc()){
                $data .= '<option value="'.$row['id'].'" '.(($row['section'] == $section) ? "selected":"").'>'.$row['section'].'</option>';
            }
            echo $data;
        }else{
            echo $db->error;
        }

    }
}
?>