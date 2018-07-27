<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_mano'])){
$nombre_mano=filtroxss($_POST['nombre_mano']);
$horas=filtroxss($_POST['horas']);
$precio=filtroxss($_POST['precio']);
$id_mano=filtroxss($_POST['id_mano']);
if(($nombre_mano=="") || ($horas=="") || ($precio=="")){
	echo negativo("Uno de los campos esta vacio");
	exit;
}
$si=0;
$upd=("UPDATE mano_de_obra SET nombre='$nombre_mano',horas='$horas', precio='$precio' WHERE id_mano='$id_mano'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])>=1){
	$si=($si+1);
}

$id_detalle=$_POST['id_detalle'];
foreach($id_detalle as $num=>$id){
$nombre=$_POST['nombres'][$num];
if($nombre==""){
$del=("DELETE FROM descripcion_mano_de_obra WHERE id_descripcion='$id' LIMIT 1");
cons($del);
$si=($si+1);
}else{
$upd=("UPDATE descripcion_mano_de_obra SET nombre='$nombre' WHERE id_descripcion='$id' LIMIT 1");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])>=1){
	$si=($si+1);
}
}
}
if(isset($_POST['trabajos'])){
$trabajos=$_POST['trabajos'];
foreach($trabajos as $detalle){
$detalle=strtoupper($detalle);
$insr=("INSERT INTO descripcion_mano_de_obra (id_mano,nombre)
	VALUES ('$id_mano','$detalle')");
cons($insr);
if(mysqli_affected_rows($_SESSION['conexion_database'])>=1){
	$si=($si+1);
}

}
}
if($si==0){
echo negativo("No se realizo ningun cambio");
}else{
echo positivo("Solicitud procesada exitosamente");
?>
<script>
function redireccionar(){window.location="tra_mano.php";} 
setTimeout ("redireccionar()", 2000);
</script>
<?php
}


}
}
?>