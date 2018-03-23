<?php
    include("functions.php");
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST['x']);
    $result = $db->query("DELETE FROM `permit` WHERE `permit`.`permitno` = $obj->no");
    echo mysqli_error($db);
?>