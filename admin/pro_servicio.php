<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['codigo'])){
if(isset($_POST['descripcion'])){
if(isset($_POST['monto'])){
if(isset($_POST['costo_servicio'])){
if(isset($_POST['id_or'])){
if(isset($_POST['nombre_servicio'])){
$id_or=filtroxss($_POST['id_or']);
$codigo=filtroxss($_POST['codigo']);
$nombre_servicio=filtroxss($_POST['nombre_servicio']);
$descripcion=filtroxss($_POST['descripcion']);
$monto1=$_POST['monto'];
if (is_numeric($monto1)) {

	}else{
		echo negativo("Coloque un precio V&aacute;lido para el Monto");
		exit;		
	}
$costo1=$_POST['costo_servicio'];
if (is_numeric($costo1)) {

	}else{
		echo negativo("Coloque un precio V&aacute;lido para el Costo");
		exit;		
	}
$monto=filtroxss($_POST['monto']);
$costo_servicio=filtroxss($_POST['costo_servicio']);
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
while($g=mysqli_fetch_array($v)){
		$iva=$g['iva'];
	}
$cons=("SELECT * FROM servicios_or WHERE id_or='$id_or' AND codigo='$codigo' AND habilitado=0 LIMIT 1");
$d=cons($cons);
if(mysqli_num_rows($d)>=1){
	echo negativo("El servicio ya esta registrado en este OR");
	exit;
}
$ins=("INSERT INTO servicios_or (id_or,codigo,nombre_servicio,descripcion,monto,costo_servicio,habilitado) 
	VALUES ('$id_or','$codigo','$nombre_servicio','$descripcion','$monto','$costo_servicio',0)");
cons($ins);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente");
	exit;
}
$coq='<tr id="w'.$codigo.'"><td>'.$codigo.'</td><td>'.$nombre_servicio.'</td><td>'.$descripcion.'</td><td>'.number_format($monto,2,",",".").'</td><td>'.number_format($costo_servicio,2,",",".").'</td><td><button class="eliminar_servicio" id='.$codigo.'>X</button></td></tr>';
$to='<h4>Sub-Total : '.number_format(total_or($id_or),2,",",".").' Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").' Bs<br>Total: '.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").' Bs</h4>';

?>
<script>
$('#example4 tr:first').after('<?php echo $coq;?>');
$("#totales").html('<?php echo $to;?>');
</script>
<?php

}
}
}
}
}
}
}
?>