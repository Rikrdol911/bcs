<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['notas'])){
if(isset($_POST['id_or'])){
$notas=strtoupper(filtroxss($_POST['notas']));
$id_or=filtroxss($_POST['id_or']);
$upd=("UPDATE o_r SET notas='$notas' WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$d=cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error general, intentalo nuevamente");
}else{
echo positivo("Actualizado exitosamente");
}

}
}
}
?>