<?php
$conectar=TRUE; include("../../admin/conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['fecha'])){
$fecha=filtroxss($_POST['fecha']);
$datelog=date('Y-m-d');
if ($fecha!=$datelog) {
	echo negativo("Confirmar Fechas");
	exit;
}
?>