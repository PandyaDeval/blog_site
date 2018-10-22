<?php
session_start();
$_SESSION['username']='';
echo "<script>location='index.php';</script>";
?>