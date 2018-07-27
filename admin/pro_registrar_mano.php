<?php $conectar=TRUE; include("conexion.php");

if(isset($_SESSION['nombre'])){
if(isset($_POST['horas'])){	
if(isset($_POST['precio'])){
if(is_numeric($_POST['horas'])){
$nombre=strtoupper(filtroxss($_POST['nombre']));
$horas=filtroxss($_POST['horas']);
$precio=filtroxss($_POST['precio']);	
if(($nombre=="") || ($horas=="") || ($precio=="")){
echo negativo("Uno de los campos del registro esta vacio. Intentalo nuevamente!");
exit;
}
$consulta=("SELECT * FROM mano_de_obra WHERE nombre='$nombre' AND horas='$horas' AND precio='$precio' AND habilitado=0 LIMIT 1");
$f=cons($consulta);	
if(mysqli_num_rows($f)<=0){
$insr=("INSERT INTO mano_de_obra (nombre,precio,horas,habilitado)
VALUES ('$nombre','$precio','$horas',0)");
cons($insr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Hubo un error general registrando al cliente, intentalo nuevamente");
exit;	
}else{
	$id_mano=mysqli_insert_id($_SESSION['conexion_database']);
	foreach($_POST['trabajos'] as $posicion=>$posici) {
	$posici; 
	$trabajos=$_POST['trabajos'][$posicion];
	//ESAS SON TODAS LAS DINAMICAS!! LAS DEMAS NORMALES YA SABES COMO RESCATARLAS! NORMALMENTE! 
	if ($posici=="") {
		echo negativo("Error en el dato ingresado");
		exit;
	}
$insr2=("INSERT INTO descripcion_mano_de_obra (id_mano,nombre)
VALUES ('$id_mano','$trabajos')");
cons($insr2);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Hubo un error registrando los trabajos, intentalo nuevamente");
exit;	
}else{
	

}// foreach
}echo positivo("Se ha agregado la nueva mano de obra");

}//else foreach
}else{
	echo negativo("El registro ya existe");
}
}
}
}
}
?>
