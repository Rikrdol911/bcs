<?php $conectar=TRUE; include("../../admin/conexion.php");

$file='vntinfopat1.txt';
header("Content-disposition: attachment; filename=vntinfopat1.txt");
header("Content-type: MIME");
readfile("vntinfopat1.txt");
?>