<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_mano'])){
$id_mano=filtroxss($_POST['id_mano']);
$consulta=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
while($row=mysqli_fetch_array($f)){
  $id_mano=$row['id_mano'];
  $nombre_mano=$row['nombre'];
  $horas=$row['horas'];
  $precios=$row['precio'];
}
$upda=("UPDATE mano_de_obra SET habilitado=1 WHERE id_mano='$id_mano' LIMIT 1");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){

}else{
	echo positivo("Se ha Eliminado la mano ".$nombre_mano."");
}
}
}
?>