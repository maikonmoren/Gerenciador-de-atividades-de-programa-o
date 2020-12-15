<?php
session_start();
ini_set('default_charset','UTF-8');
$usu = isset($_SESSION['p_id']) ? $_SESSION['p_id'] : '';
if ($usu == null || $usu == '') {
header("location:../index.php");
exit();
}
?>

