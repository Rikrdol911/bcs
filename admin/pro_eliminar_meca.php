<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['docconf'])) {
if(isset($_POST['dni'])) {
if(isset($_POST['nombre'])) {
if(isset($_POST['id_mecanico'])){
if(is_numeric($_POST['docconf'])){
$dniconf=filtroxss($_POST['docconf']);
$dni=filtroxss($_POST['dni']);
$id_mecanico=filtroxss($_POST['id_mecanico']);
$nombre=filtroxss($_POST['nombre']);
if($id_mecanico==""){
echo negativo("Uno de los campos del vehiculo est&aacute;n vacio. Intentalo nuevamente");
exit;	
}
if ($dni!=$dniconf) {
echo negativo("El documento no corresponde. Intentalo nuevamente");
exit;	
}else{
$upd=("UPDATE mecanico SET habilitado=1 WHERE id_mecanico='$id_mecanico'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
echo positivo("Se ha Eliminado el Mecanico ".$nombre." exitosamente!");
}
?>
<script>
function redireccionar(){window.location="meca.php";} 
setTimeout ("redireccionar()", 2000);
</script>
<?php
}
}
}
}
}
}
}
?>
