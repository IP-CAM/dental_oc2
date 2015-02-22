<?php
session_start(); 
unset($_SESSION['usuario_sistema']); 
session_destroy(); 
header("Location: login.php"); 
?>