<style>
#respuesta22{
	position:fixed;
	right:0px;
	bottom:0px;
	z-index:12000000;
	
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#respuesta22").fadeOut(4500);
    },5000);
});
</script>
<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_or'])){
if(isset($_POST['id_abono_or'])){
if(isset($_POST['n_vaucher'])){
$id_or=filtroxss($_POST['id_or']);
$id_abono_or=filtroxss($_POST['id_abono_or']);
$n_vaucher=filtroxss($_POST['n_vaucher']);
$consulta=("SELECT * FROM abono_or WHERE id_abono_or='$id_abono_or' AND id_or='$id_or' AND n_vaucher='$n_vaucher' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
while($row=mysqli_fetch_array($f)){
  $id_or=$row['id_or'];
  $n_vaucher=$row['n_vaucher'];
  $id_abono_or=$row['id_abono_or'];
  $monto=$row['monto'];
}
$consulta2=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$f2=cons($consulta2);
while($row2=mysqli_fetch_array($f2)){
  $id_or=$row2['id_or'];
  $iva=$row2['iva'];
}
$total_or_ver=(total_or($id_or)+((total_or($id_or)*$iva)/100));
$total_abono_ver=total_abono($id_or)+$monto;
// if (($monto>$total_or_ver) || ($total_abono>$total_or_ver)) {
 // echo "<div id='respuesta22'>".negativo("Los montos sobre pasan al total de la Orden")."</div>";
 // exit;
//}
$upda=("UPDATE abono_or SET habilitado=1 WHERE id_abono_or='$id_abono_or' AND id_or='$id_or' LIMIT 1");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){

}else{
$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';
	echo "<div id='respuesta22'>".positivo("Se ha eliminado el abono $n_vaucher")."</div>";
	?>
<script>
$('#x<?php echo $id_abono_or;?>').remove();
$("#totales").html('<?php echo $to;?>');
</script>
	<?php
}
}
}
}
}
?>