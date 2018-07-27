<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['precio'])){
if(isset($_POST['id_or'])){
if(isset($_POST['id_pieza'])){
if(isset($_POST['cantidad'])){
$precio1=$_POST['precio'];
if (is_numeric($precio1)) {

	}else{
		echo negativo("Coloque un precio V&aacute;lido");
		exit;		
	}
	$precio=filtroxss($_POST['precio']);
$id_or=filtroxss($_POST['id_or']);
$id_pieza=filtroxss($_POST['id_pieza']);
$cantidad=filtroxss($_POST['cantidad']);
$ff="0000-00-00";
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND fecha_cierre='$ff' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
if(mysqli_num_rows($v)>=1){
	while($g=mysqli_fetch_array($v)){
		$iva=$g['iva'];
	}
$consulta=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' AND (habilitado=0 OR habilitado=3) LIMIT 1");
$f=cons($consulta);
while($rf=mysqli_fetch_array($f)){
$nombre=$rf['nombre'];
$codigo=$rf['codigo_pieza'];
$habilitado=$rf['habilitado'];
}
$consult=("SELECT * FROM repuesto_or WHERE id_pieza='$id_pieza' AND id_or='$id_or' AND (habilitado=0 OR habilitado=3) LIMIT 1");
$dd=cons($consult);
if(mysqli_num_rows($dd)>=1){
echo negativo("Ya la pieza esta en el OR");
	exit;
}
$disponible=cantidad($id_pieza);
if($disponible<$cantidad){
	echo negativo("No hay suficiente cantidad en el inventario");
	exit;
}
$taller=0;
if(isset($_POST['taller'])){
	if($_POST['taller']==1){
		$taller=1;
	$colocar=number_format(($cantidad*$precio),2,",",".");
	$upd=("UPDATE inventario SET precio='$precio' WHERE id_pieza='$id_pieza' AND habilitado='$habilitado'");
	cons($upd);
	}
}
$ins=("INSERT INTO repuesto_or (id_or,id_pieza,cantidad,precio,taller,habilitado)
	VALUES ('$id_or','$id_pieza','$cantidad','$precio','$taller','$habilitado')");
cons($ins);
if($taller==0){
	$colocar=number_format(($cantidad*$precio),2,",",".");
	$upd=("UPDATE inventario SET precio='$precio' WHERE id_pieza='$id_pieza' AND habilitado='$habilitado'");
	cons($upd);
}else{
	$colocar="Traido Por Cliente";
	$precio="Traido Por Cliente";
}
$coq="<tr id="."b".$id_pieza."><td>".$codigo."</td><td>".$nombre."</td><td>".$cantidad."</td><td>".$precio." Bs</td><td>".$colocar."</td><td><button class=".'eliminar_repuesto'." id=".$id_pieza.">X</button></td></tr>";
$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';

?>
<script>
$('#example3 tr:first').after('<?php echo $coq;?>');
$("#totales").html('<?php echo $to;?>');
</script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#respuesta22").fadeOut(4500);
    },5000);
});
</script>
<?php

}else{
	echo negativo("El OR no existe");
}



}
}
}
}
}
?>