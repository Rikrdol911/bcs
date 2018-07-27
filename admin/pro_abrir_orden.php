<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_carro'])){
if(isset($_POST['id_mecanico'])){
if(isset($_POST['numero_or'])){	
$id_carro=filtroxss($_POST['id_carro']);
$id_mecanico=filtroxss($_POST['id_mecanico']);
$numero_or=filtroxss($_POST['numero_or']);
$kilometraje=filtroxss($_POST['kilometraje']);
$iva=filtroxss($_POST['iva']);
$cos=("SELECT * FROM o_r WHERE numero_or='$numero_or' LIMIT 1");
$x=cons($cos);
if(mysqli_num_rows($x)>=1){
echo negativo("El numero de OR ya existe");
	exit;
}
$consu=("SELECT * FROM o_r WHERE id_carro='$id_carro' AND fecha_cierre='0000-00-00' AND (habilitado=0 OR habilitado=3) LIMIT 1");
$t=cons($consu);
if(mysqli_num_rows($t)>=1){
echo negativo("Existe una OR abierta para este vehiculo");
	exit;
}

$consulta=("SELECT * FROM carro WHERE id_carro='$id_carro' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
if(mysqli_num_rows($v)<=0){
echo negativo("El vehiculo no existe en la base de datos");
	exit;
}
$fv=("SELECT * FROM mecanico WHERE id_mecanico='$id_mecanico' AND habilitado=0 LIMIT 1");
$a=cons($fv);
if(mysqli_num_rows($a)<=0){
echo negativo("Error, el mecanico no existe");
	exit;
}
while($fd=mysqli_fetch_array($v)){
$id_cliente=$fd['id_cliente'];
$hoy=date("Y-m-d");
$array=serialize(array());
$ins=("INSERT INTO o_r (id_cliente,id_carro,numero_or,id_mecanico,fecha_apertura,array_mano_obra,array_horas,array_precio,array_garantia,array_titulo,iva,kilometros,habilitado,imp)
	VALUES ('$id_cliente','$id_carro','$numero_or','$id_mecanico','$hoy','$array','$array','$array','$array','$array','$iva','$kilometraje',0,0)");
	cons($ins);
	if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General, intentalo nuevamente");
	}else{
		$id=mysqli_insert_id($_SESSION['conexion_database']);
echo positivo("OR Numero ".$numero_or." generada exitosamente<br>Para ver detalles de la OR haz <a href='detalles_or.php?id_or=".$id."'>Clic Aqui</a>");
	}


}


}


}
}
}