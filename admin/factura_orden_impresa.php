<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_or'])){
$id_or=filtroxss($_POST['id_or']);
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 AND imp=1 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)>0){
echo alerta("Error 001");
exit; 
}else{
$upd=("UPDATE o_r SET imp=1 WHERE id_or='$id_or' LIMIT 1");
	cons($upd);
	if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error 005!");
exit;
}
?>
<script>
function redireccionar(){window.location="ordenes_or.php";} 
setTimeout ("redireccionar()", 15000);
</script>
<?php
}
}
}
?>
