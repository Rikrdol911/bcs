<?php $conectar=TRUE; include("conexion.php");
print_r($_POST);
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_pieza'])){
if(isset($_POST['id_or'])){
$id_or=filtroxss($_POST['id_or']);
$id_pieza=filtroxss($_POST['id_pieza']);
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
while($g=mysqli_fetch_array($v)){
		$iva=$g['iva'];
	}
$consultaa=("SELECT * FROM repuesto_or WHERE id_pieza='$id_pieza' AND id_or='$id_or' AND (habilitado=0 OR habilitado=3) LIMIT 1");
$ds=cons($consultaa);
while($ro=mysqli_fetch_array($ds)){
$upda=("UPDATE repuesto_or SET habilitado=1 WHERE id_or='$id_or' AND id_pieza='$id_pieza'");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){

}else{
$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';
	?>
<script>
$('#b<?php echo $id_pieza;?>').remove();
$("#totales").html('<?php echo $to;?>');
</script>
	<?php
}

}




}
}
}
?>