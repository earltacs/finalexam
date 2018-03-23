<?php 
    include("database.php");
    session_start();
    function session_check(){
        if(isset($_SESSION['username'])){
            header("location: home.php?username=".$_SESSION['username']."&type=".$_SESSION['type']."");
        }else{
            header("location: ../index.php");
        }
    }
?>