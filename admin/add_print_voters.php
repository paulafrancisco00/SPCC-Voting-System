<?php
//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");

require("classes/Grade.php");

include('sidebar.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPCC Voting System</title>
	<style>
		@media print {
			.noprint {
				display: none;
			}
		}
	</style>
</head>

<body>
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="noprint">
			<button style="margin-bottom: 10px;" class="btn btn-secondary btnPrint ">Print Data</button>
		</div>
			
			<br>
<?php 
	$res = mysqli_query($db, "SELECT * FROM voters");

	echo '<table class="table table-striped" id="results">
	<thead>
	<tr>
	<th>Student Number</th>
	<th>Last Name</th>
	<th>First Name</th>
	<th>Middle Name</th>
	<th>Voters Code</th>
	</tr>
	</thead>';
	while($row = mysqli_fetch_array($res)){
		echo "<tbody>";
		echo "<tr>";
		echo "<td>"; echo $row["student_number"]; echo "</td>";
		echo "<td>"; echo $row["last_name"]; echo "</td>";
		echo "<td>"; echo $row["first_name"]; echo "</td>";
		echo "<td>"; echo $row["middle_name"]; echo "</td>";
		echo "<td>"; echo $row["voters_code"]; echo "</td>";		
		echo "</tr>";
		echo "</tbody>";
		
		echo "</div>";
	}
?>

</div>
</div>

</body>
</html>
<script>
	$('.btnPrint').click(function(){
         var x = document.querySelector(".myDIV"); 	
            var printme = document.getElementById('results');
            var wme = window.open(window.print());
            wme.document.write(printme.outerHTML);           
            wme.document.close();
            wme.focus();        
            wme.close();
        

        });
</script>