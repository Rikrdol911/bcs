<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['fechaconf'])){
$fechaconf=filtroxss($_POST['fechaconf']);
$fechahoy1=date('Y-m-d');
if(($fechaconf=="") || ($fechahoy1=="")){
	echo negativo("Ha ocurrido un Error, int&eacute;talo Nuevamente");
exit;
}
if ($fechahoy1==$fechaconf) {
$upd=("UPDATE factura SET habilitado=3 WHERE habilitado=0");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("No hay Facturas o no se han actualizado!");
}
$upd2=("UPDATE o_r SET habilitado=3 WHERE habilitado=0 AND fecha_cierre!='000-00-00'");
cons($upd2);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("No hay Ordenes Cerradas o no se han actualizado!");
exit;	
}else{ echo positivo("Se he cerrado el A&ntilde;o Fiscal");
?>
<script>
function redireccionar(){window.location="index.php";} 
setTimeout ("redireccionar()", 4000);
</script>
<?php
}
}else{
	echo negativo("Error en el Registro de Fecha");
	exit;
}
}
}
?>