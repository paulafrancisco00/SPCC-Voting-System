<?php
//Include database connection
require("../config/db.php");

?>
<html>


<?php
$sql = "SELECT * FROM manage_strand";
if(!$stmt = $db->prepare($sql)) {
    echo $stmt->error;
} else {
    $stmt->execute();
    $result = $stmt->get_result();
}
?>


<option value="">*****Select Strand*****</option>
<?php if($result) { ?>
    <?php while($rowPos = $result->fetch_assoc()) { ?>
        <option value="<?php echo $rowPos['id']; ?>"><?php echo $rowPos['strand']; ?></option>
    <?php } //End while ?>
<?php } //End if ?>

</html>