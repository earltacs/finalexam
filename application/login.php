<?php
	include("functions.php");
	header("Content-Type: application/json; charset=UTF-8");
	$data = json_decode($_POST['d']);
    $pass = hash("sha256", $data->password);
	$result = $db->query("SELECT username, `password`, `type` FROM accounts WHERE username = '$data->username' LIMIT 1");
	$rd = mysqli_fetch_assoc($result);
	if(strcmp($rd['password'], $pass) == 0){ 
		$_SESSION['username'] = $rd['username'];
		$_SESSION['type'] = $rd['type'];
		echo json_encode( $rd );
	}else{ echo mysqli_error($db); }
?>