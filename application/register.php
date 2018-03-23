<?php
	include("functions.php");
	header("Content-Type: application/json; charset=UTF-8");
    $data = json_decode($_POST['d']);
    $pass = hash("sha256", $data->password);
    $result = $db->query("INSERT INTO accounts (username, `password`, `type`, firstname, middlename, lastname) VALUES ('$data->username', '$pass', 'NU', '$data->firstname', '$data->middlename', '$data->lastname')");
    if(mysqli_errno($db) == 0){
        echo "success";
    }else{
        echo mysqli_error($db);
    }
?>