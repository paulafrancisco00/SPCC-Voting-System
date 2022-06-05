<?php
require("process/auth.php");

//Include database connection
require("../config/db.php");

//include('sidebar.php');

if(isset($_POST['key'])){
	if($_POST['key'] == 'showresult'){
		$partylist = $_POST['partylist'];
		$positions = ['President','Vice President','Secretary','Auditor','Treasurer','Peace Officer','P.I.O'];
		$data = "";
		foreach($positions as $pos){
			if($partylist == "ALL"){
				$sql = $db->query("SELECT n.id, CONCAT(n.last_name,', ',n.first_name,' ',n.middle_name) AS name, n.partylist, COUNT(v.id) AS archived_votes FROM nominees n, archived_votes v WHERE n.id = v.candidate_id AND v.pos = '$pos' GROUP BY n.id");
			}else{
				$sql = $db->query("SELECT n.id, CONCAT(n.last_name,', ',n.first_name,' ',n.middle_name) AS name, n.partylist, COUNT(v.id) AS archived_votes FROM nominees n, archived_votes v WHERE n.id = v.candidate_id AND v.pos = '$pos' AND v.partylist = '$partylist' GROUP BY n.id");
			}
			$data .= '
				<h5>'.$pos.'</h5>
				<table class="table table-condensed table-striped" >
	                <thead>
	                    <tr>
	                        <th>ID</th>
	                        <th>Name</th>
	                     
	                        <th>Votes</th>

	                    </tr>
	                </thead>
	                <tbody>
			';
				while($row = $sql->fetch_assoc()){
					$data .= '
						<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['name'].'</td>
							
							<td>'.$row['archived_votes'].'</td>
						</tr>
					';
				}

			$data .= '
					</tbody>
				</table>
			';
		}

		echo $data;

	}
}

?>