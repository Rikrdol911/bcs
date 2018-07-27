<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_mano'])){
if(isset($_POST['id_or'])){
$id_or=filtroxss($_POST['id_or']);
$id_mano=filtroxss($_POST['id_mano']);
$consultaa=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$da=cons($consultaa);
while($ro=mysqli_fetch_array($da)){
	$titu=unserialize($ro['array_titulo']);
	$mano=unserialize($ro['array_mano_obra']);
	$horas=unserialize($ro['array_horas']);
	$precio=unserialize($ro['array_precio']);
	$garantia=unserialize($ro['array_garantia']);
	$clave=array_search($id_mano, $titu);
$iva=$ro['iva'];
	unset($titu[$clave]);
	unset($mano[$clave]);
    unset($horas[$clave]);
	unset($precio[$clave]);
	unset($garantia[$clave]);

$mano=serialize($mano);
$hors=serialize($horas);
$prec=serialize($precio);
$gar=serialize($garantia);
$titu=serialize($titu);
$upda=("UPDATE o_r SET array_mano_obra='$mano', array_titulo='$titu', array_horas='$hors', array_precio='$prec', array_garantia='$gar' WHERE id_or='$id_or' LIMIT 1");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){

}else{
	$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';

	?>
<script>
$('#x<?php echo $id_mano;?>').remove();
$("#totales").html('<?php echo $to;?>');
</script>
	<?php
}

}




}
}
}
?>