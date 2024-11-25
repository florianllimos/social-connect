<?php

require_once("database.php");

session_start();

if(isset($_SESSION['email'])){
    session_destroy();
    
    $_SESSION = array();
    
    session_unset();
    
    session_regenerate_id(true);
}

header("Location: ../index.php");
exit();
?>
