<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['placaconf'])) {
if(isset($_POST['placa'])){
$placa=strtoupper(filtroxss($_POST['placa']));
$placaconf=strtoupper(filtroxss($_POST['placaconf']));
if($placa==""){
echo negativo("Uno de los campos del vehiculo est&aacute;n vacio. Intentalo nuevamente");
exit;	
}
if ($placa!=$placaconf) {
echo negativo("La placa no corresponde. Intentalo nuevamente");
exit;	
}else{
$upd=("UPDATE carro SET habilitado=1 WHERE placa='$placa'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
echo positivo("Se ha Eliminado el vehiculo ".$placa." exitosamente!");
}
?>
<script>
function redireccionar(){window.location="registrar_carro.php";} 
setTimeout ("redireccionar()", 2000);
</script>
<?php
}
}
}
}

?>