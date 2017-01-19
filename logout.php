<?php
session_start();
unset($_SESSION["myadmin"]);
session_destroy();
header("location:login.php");
?>