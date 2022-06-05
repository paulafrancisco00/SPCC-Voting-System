<?php
//Include database connection
require("../config/db.php");

?>
<html>


<?php
//$grade = trim($_POST['grade']);
$strand = trim($_POST['strand']);
$sql = "SELECT * FROM manage_section WHERE  strand = ?";
if(!$stmt = $db->prepare($sql)) {
    echo $stmt->error;
} else {
    $stmt->bind_param("s", $strand);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>


<option value="">*****Select Section*****</option>
<?php if($result) { ?>
    <?php while($rowPos = $result->fetch_assoc()) { ?>
        <option value="<?php echo $rowPos['section']; ?>"><?php echo $rowPos['section']; ?></option>
    <?php } //End while ?>
<?php } //End if ?>

</html>