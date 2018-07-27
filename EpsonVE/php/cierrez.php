<?php
 //dl("php_tm20v52ts.dll");
require_once ('TM20PhpApi.php');
$conectar=TRUE; include("../../admin/conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['fecha'])){
$fecha=filtroxss($_POST['fecha']);
$datelog=date('Y-m-d');
if ($fecha!=$datelog) {
	echo negativo("Confirmar Fechas");
	exit;
}else{
  $err = IF_OPEN("COM2",9600);

  if ( $err == -1) 
  {   echo "impresora ocupada";   return;  }

  $err = IF_WRITE("@DailyClose|Z");
  $err =IF_CLOSE();
echo positivo("Se ejecutara el cierre Z en Breve");
}
}
}
?>
