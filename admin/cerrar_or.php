<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_or'])){
	$fecha=date("Y-m-d");
	$id_or=filtroxss($_POST['id_or']);
$upd=("UPDATE o_r SET fecha_cierre='$fecha' WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("No se proceso, Intentalo nuevamente");
}else{
echo positivo("OR Finalizada");
echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL=detalles_or.php?id_or='.$id_or.'">';
}

}
}
?>