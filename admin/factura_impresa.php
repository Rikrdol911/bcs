<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_factura'])){
$id_factura=filtroxss($_POST['id_factura']);  
$consulta=("SELECT * FROM factura WHERE id_factura='$id_factura' AND habilitado=0 AND imp=1 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)>0){
echo alerta("Error 001");
exit; 
}else{
$upd=("UPDATE factura SET imp=1 WHERE id_factura='$id_factura' LIMIT 1");
	cons($upd);
	if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error 005!");
exit;
}else{
echo positivo("Se ha Ejecutado la impresión");	
?>
<script>
function redireccionar(){window.location="ver_facturar.php";} 
setTimeout ("redireccionar()", 5000);
</script>
<?php
}
}
}
}
?>