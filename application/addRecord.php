<?php
    include("functions.php");
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST['x']);
    $result = $db->query("INSERT INTO permit VALUES (null, '$obj->username', '$obj->msg', '$obj->type', 'pending')");
    echo mysqli_error($db);
?>