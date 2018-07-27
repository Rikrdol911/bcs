<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_or'])){
if(isset($_POST['nid_mecanico'])){
if(isset($_POST['nkm'])){
if(isset($_POST['iva'])){
$nid_mecanico=filtroxss($_POST['nid_mecanico']);
$nkm=filtroxss($_POST['nkm']);
$id_or=filtroxss($_POST['id_or']);
$iva=filtroxss($_POST['iva']);
if(($nid_mecanico=="") || ($nkm=="")|| ($iva=="")){
echo negativo("Uno de los campos esta vacio. Intentalo nuevamente");
exit;	
}
$consulta=("SELECT * FROM o_r WHERE id_mecanico='$nid_mecanico' AND kilometros='$nkm' AND id_or='$id_or' AND iva='$iva' LIMIT 1");
$dv=cons($consulta);
if(mysqli_num_rows($dv)>=1){
	echo negativo("Debes realizar al menos un cambio");
exit;	
}
else{
$upd=("UPDATE o_r SET id_mecanico='$nid_mecanico',kilometros='$nkm',iva='$iva' WHERE id_or='$id_or'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
echo positivo("Se ha actualizado la OR exitosamente!");
}
exit;
}

}
}
}
}
}
?>