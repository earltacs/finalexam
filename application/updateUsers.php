<?php
    include("functions.php");
    header("Content-Type: application/json; charset=UTF-8");
    $data = json_decode($_POST['d']);
    $result = $db->query("UPDATE accounts SET `type` = '$data->type' WHERE username = '$data->username'");
    echo mysqli_error($db);
?>