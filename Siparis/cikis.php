<?php

session_start();
session_destroy();
session_unset();
unset($_SESSION['oturum']);
header("Location:index.php");
?>