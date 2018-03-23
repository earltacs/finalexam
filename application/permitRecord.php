<?php
    include("functions.php");
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST['x']);
    $result = $db->query("UPDATE permit SET permitted = '$obj->permission' WHERE permitno = $obj->id");
    echo mysqli_error($db);
?>