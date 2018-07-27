<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['conf_numero_or'])){
if(isset($_POST['numero_or'])){
if(isset($_POST['id_or'])){
$conf_numero_or=filtroxss($_POST['conf_numero_or']);
$numero_or=filtroxss($_POST['numero_or']);
$id_or=filtroxss($_POST['id_or']);
if($conf_numero_or==""){
echo negativo("Uno de los campos del vehiculo est&aacute;n vacio. Intentalo nuevamente");
exit;	
}
if ($conf_numero_or!=$numero_or) {
echo negativo("El n&uacute;mero de orden no corresponde. Intentalo nuevamente");
exit;	
}else{
$upd=("UPDATE o_r SET habilitado=1 WHERE id_or='$id_or'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General 1. Intentalo nuevamente!");
exit;	
}else{
$upd2=("UPDATE repuesto_or SET habilitado=1 WHERE id_or='$id_or'");
cons($upd2);
if(mysqli_affected_rows($_SESSION['conexion_database'])>=0){
echo positivo("Se han Eliminado los repuestos de la Orden!");	
}else{
echo positivo("La Orden No tenia Repuestos!");	
}
$upd3=("UPDATE servicios_or SET habilitado=1 WHERE id_or='$id_or'");
cons($upd3);
if(mysqli_affected_rows($_SESSION['conexion_database'])>=0){
echo positivo("Se han Eliminado los Servicios de la Orden!");	
}else{
echo positivo("La Orden No tenia Servicios!");	
}
}
echo positivo("Se ha Eliminado la Orden");
?>
<script>
function redireccionar(){window.location="ordenes_or.php";} 
setTimeout ("redireccionar()", 4000);
</script>
<?php
}



}
}
}
}
?>