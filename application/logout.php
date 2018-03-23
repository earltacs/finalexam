<?php
    include("functions.php");
    unset($_SESSION['username']);
    unset($_SESSION['type']);
    session_destroy();
    session_check();
?>