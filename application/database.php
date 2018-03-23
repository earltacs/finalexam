<?php
	$db = new mysqli("localhost", "root", "");
	if(mysqli_errno($db) == 0){
		mysqli_select_db($db, "pims");
		if(mysqli_errno($db) != 0){
			exit(mysqli_error($db));
		}
	}else{exit(mysqli_error($db));}
?>