<?php
	include("functions.php");	
	$result = $db->query("SELECT * FROM permit");
	echo "<table id='permit-table'>
		<tr>
			<th> Permit No. </th>
			<th> Message </th>
			<th> Sender </th>
			<th> Type </th>
			<th> Permission </th>
			<th> Action </th>
		</tr>";
	if(mysqli_num_rows($result) != 0)
	{
		$data = $result->fetch_all(MYSQLI_ASSOC);
		if(strcmp($_SESSION['type'], "SU") == 0){
			foreach($data as $value){
				$userresult = $db->query("SELECT * FROM accounts WHERE username = '".$value['username']."'");
				$userdata = $userresult->fetch_assoc();
				echo "<tr>";
					echo "<td>".$value['permitno']."</td>
						<td>".$value['permitmessage']."</td>
						<td>".$userdata['lastname'].", ".$userdata['middlename']." ".$userdata['firstname']."</td>
						<td>".$value['type']."</td>
						<td>".$value['permitted']."</td>";
						if(strcmp($value['permitted'], "pending") == 0){
							echo "<td>
								<button type='button' class='accept' onclick='permitDemand(this, ".$value['permitno'].")'> Accept </button>
								<button type='button' class='reject' onclick='permitDemand(this, ".$value['permitno'].")'> Reject </button>
								<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
								<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
							</td>";
						}else{
							if(strcmp($value['permitted'], "accepted") == 0){
								echo "<td>
									<button type='button' class='reject' onclick='permitDemand(this, ".$value['permitno'].")'> Reject </button>
									<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
									<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
								</td>";
							}else{
								echo "<td>
									<button type='button' class='accept' onclick='permitDemand(this, ".$value['permitno'].")'> Accept </button>
									<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
									<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
								</td>";
							}
						}
				echo "</tr>";
			}
		}else if(strcmp($_SESSION['type'], "OU") == 0){
			foreach($data as $value){
				$userresult = $db->query("SELECT * FROM accounts WHERE username = '".$value['username']."'");
				$userdata = $userresult->fetch_assoc();
				echo "<tr>";
				if(strcmp($value['type'], "SU") != 0){
					echo "<td>".$value['permitno']."</td>
						<td>".$value['permitmessage']."</td>
						<td>".$userdata['lastname'].", ".$userdata['middlename']." ".$userdata['firstname']."</td>
						<td>".$value['type']."</td>
						<td>".$value['permitted']."</td>";
					if(strcmp($value['permitted'], "pending") == 0){
						echo "<td>
							<button type='button' class='accept' onclick='permitDemand(this, ".$value['permitno'].")'> Accept </button>
							<button type='button' class='reject' onclick='permitDemand(this, ".$value['permitno'].")'> Reject </button>
							<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
							<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
						</td>";
					}else{
						if(strcmp($value['permitted'], "accepted") == 0){
							echo "<td>
								<button type='button' class='reject' onclick='permitDemand(this, ".$value['permitno'].")'> Reject </button>
								<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
								<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
							</td>";
						}else{
							echo "<td>
								<button type='button' class='accept' onclick='permitDemand(this, ".$value['permitno'].")'> Accept </button>
								<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
								<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
							</td>";
						}
					}
				}else{
					if(strcmp($value['permitted'], "accepted") == 0){
							echo "<td>".$value['permitno']."</td>
							<td>".$value['permitmessage']."</td>
							<td>".$userdata['lastname'].", ".$userdata['middlename']." ".$userdata['firstname']."</td>
							<td>".$value['type']."</td>
							<td>".$value['permitted']."</td>
							<td>You are not authorized </td>";
					}
				}
				echo "</tr>";
			}
		}else{
			foreach($data as $value){
				$userresult = $db->query("SELECT * FROM accounts WHERE username = '".$value['username']."'");
				$userdata = $userresult->fetch_assoc();
				echo "<tr>";
					if(strcmp($value['type'], "SU") != 0 && strcmp($value['type'], "OU") != 0){
						if(strcmp($_SESSION['username'], $userdata['username']) == 0){
							echo "<td>".$value['permitno']."</td>
								<td>".$value['permitmessage']."</td>
								<td>".$userdata['lastname'].", ".$userdata['middlename']." ".$userdata['firstname']."</td>
								<td>".$value['type']."</td>
								<td>".$value['permitted']."</td>
								<td>
									<button type='button' id='blue-btn' class='".$value['permitmessage']."' onclick='showEdit(this, ".$value['permitno'].")'> Edit </button>
									<button type='button' id='red-btn' onclick='deleteRecord(".$value['permitno'].")'> Delete </button>
								</td>";
						}else{
							if(strcmp($value['permitted'], "accepted") == 0){
								echo "<td>".$value['permitno']."</td>
									<td>".$value['permitmessage']."</td>
									<td>".$userdata['lastname'].", ".$userdata['middlename']." ".$userdata['firstname']."</td>
									<td>".$value['type']."</td>
									<td>".$value['permitted']."</td>
									<td> You didn't create this permit </td>";
							}
						}
					}
				echo "</tr>";
			}
		}
	}else{
		echo "<tr> <td colspan='6'> No records found </td> </tr>";
	}
	echo "</table>";
?>