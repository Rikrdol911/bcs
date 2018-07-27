<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['placa'])){
if(isset($_POST['nid_marca'])){
if(isset($_POST['nid_cliente'])){	
if(isset($_POST['nvin'])){
if(isset($_POST['nmodelo'])){
if(isset($_POST['nserial_motor'])){
if(isset($_POST['nano'])){
if(isset($_POST['ncolor'])){
if(isset($_POST['nplaca'])){
if(isset($_POST['ncilindro'])){
if(isset($_POST['ncaja'])){
if(isset($_POST['nvalvula'])){
if(isset($_POST['nnombre_contacto'])){
if(isset($_POST['ntelefono_contacto'])){

$nid_marca=filtroxss($_POST['nid_marca']);
$nid_cliente=filtroxss($_POST['nid_cliente']);
$nvin=strtoupper(filtroxss($_POST['nvin']));
$nmodelo=strtoupper(filtroxss($_POST['nmodelo']));
$nserial_motor=strtoupper(filtroxss($_POST['nserial_motor']));
$nano=strtoupper(filtroxss($_POST['nano']));
$ncolor=strtoupper(filtroxss($_POST['ncolor']));
$placa=strtoupper(filtroxss($_POST['placa']));
$nplaca=strtoupper(filtroxss($_POST['nplaca']));
$ncilindro=strtoupper(filtroxss($_POST['ncilindro']));
$ncaja=strtoupper(filtroxss($_POST['ncaja']));
$nvalvula=strtoupper(filtroxss($_POST['nvalvula']));
$nnombre_contacto=strtoupper(filtroxss($_POST['nnombre_contacto']));
$ntelefono_contacto=strtoupper(filtroxss($_POST['ntelefono_contacto']));

if(($nvin=="") || ($nmodelo=="") || ($ncolor=="") || ($nano=="") || ($nplaca=="") || ($ncilindro=="") || ($ncaja=="")  || ($placa=="") || ($nvalvula=="") || ($nnombre_contacto=="") || ($ntelefono_contacto=="")){
echo negativo("Uno de los campos del registro del vehiculo estan vacios. Intentalo nuevamente");
exit;	
}

$ncontacto=$nnombre_contacto."!#!".$ntelefono_contacto;
$consulta=("SELECT * FROM carro WHERE id_marca='$nid_marca' AND vin='$nvin' AND modelo='$nmodelo' AND color='$ncolor' AND ano='$nano' AND placa='$nplaca' AND cilindro='$ncilindro' AND serial_motor='$nserial_motor' AND caja='$ncaja' AND valvula='$nvalvula' AND contacto='$ncontacto' AND id_cliente='$nid_cliente' AND habilitado=0 LIMIT 1");
$dv=cons($consulta);
if(mysqli_num_rows($dv)>=1){
	echo negativo("Debes realizar al menos un cambio");
exit;	
}
else{
$upd=("UPDATE carro SET id_marca='$nid_marca',id_cliente='$nid_cliente',vin='$nvin',modelo='$nmodelo',serial_motor='$nserial_motor',ano='$nano',placa='$nplaca',color='$ncolor',cilindro='$ncilindro',caja='$ncaja',valvula='$nvalvula',contacto='$ncontacto' WHERE placa='$placa'");
cons($upd);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente!");
exit;	
}else{
	$placa=$nplaca;
echo positivo("Se ha actualizado el vehiculo ".$placa." exitosamente!");
}
exit;
}
}



}	
}
}
}
}
}
}
}
}
}
}
}
}






	
	
	
}
?>