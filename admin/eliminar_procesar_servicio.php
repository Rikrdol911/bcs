<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['codigo'])){
if(isset($_POST['id_or'])){
$id_or=filtroxss($_POST['id_or']);
$codigo=filtroxss($_POST['codigo']);
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
while($g=mysqli_fetch_array($v)){
		$iva=$g['iva'];
	}
$consultas=("SELECT * FROM servicios_or WHERE codigo='$codigo' AND id_or='$id_or' LIMIT 1");
$ds=cons($consultas);
while($ro=mysqli_fetch_array($ds)){
$upda=("UPDATE servicios_or SET habilitado=1 WHERE codigo='$codigo' AND id_or='$id_or' AND habilitado=0 LIMIT 1");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){

}else{
	$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';
	?>
<script>
$('#w<?php echo $codigo;?>').remove();
$("#totales").html('<?php echo $to;?>');
</script>
	<?php
}

}




}
}
}
?>