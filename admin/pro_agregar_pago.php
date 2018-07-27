<?php $conectar=TRUE; include("conexion.php");
?>
<style type="text/css">
td, th {
    padding: 0;
}
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
td, th {
    display: table-cell;
    vertical-align: inherit;
}
#respuesta22{
	position:fixed;
	right:0px;
	bottom:0px;
	z-index:12000000;
	
}
</style>
<?php
if(isset($_SESSION['ingreso'])){
if (isset($_POST['id_or'])) {
if (isset($_POST['id_tipo_pago'])) {
if (isset($_POST['n_vaucher'])) {
if (isset($_POST['monto'])) {
if (isset($_POST['fecha_pago'])) {
if (isset($_POST['persona'])) {

$monto1=$_POST['monto'];
if (is_numeric($monto1)) {
}else{
echo negativo("Coloque un precio V&aacute;lido");
exit;		
}
$id_or=filtroxss($_POST['id_or']);
$id_tipo_pago=filtroxss($_POST['id_tipo_pago']);
$n_vaucher=filtroxss($_POST['n_vaucher']);
$monto=filtroxss($_POST['monto']);
$fecha1=filtroxss($_POST['fecha_pago']);
$persona=filtroxss($_POST['persona']);
$explode1=explode('/', $fecha1);
$fecha=$explode1[2]."-".$explode1[0]."-".$explode1[1];
if(($id_tipo_pago=="") || ($n_vaucher=="") || ($id_or=="") || ($fecha=="") || ($monto=="") || ($persona=="")){
echo negativo("Uno de los campos esta vacio");
	exit;
}
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
while($g=mysqli_fetch_array($v)){
		$iva=$g['iva'];
	}
$cons=("SELECT * FROM abono_or WHERE id_or='$id_or' AND id_tipo_pago='$id_tipo_pago' AND n_vaucher='$n_vaucher' AND monto='$monto' AND habilitado=0 LIMIT 1");
$d=cons($cons);
if(mysqli_num_rows($d)>=1){
	echo negativo("El pago ya esta registrado en este OR");
	exit;
}
$total_or_ver=(total_or($id_or)+((total_or($id_or)*$iva)/100));
$total_abono_ver=total_abono($id_or)+$monto;
//if (($monto>$total_or_ver) || ($total_abono_ver>$total_or_ver)) {
//	echo "<div id='respuesta22'>".negativo("Los montos sobre pasan al total de la Orden")."</div>";
	//exit;
//}
$ins=("INSERT INTO abono_or (id_or,fecha,id_tipo_pago,n_vaucher,monto,persona,habilitado) 
	VALUES ('$id_or','$fecha','$id_tipo_pago','$n_vaucher','$monto','$persona',0)");
cons($ins);

if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Error General. Intentalo nuevamente");
	exit;
}
$id_abono_or=mysqli_insert_id($_SESSION['conexion_database']);

$consulta3=("SELECT * FROM tipo_pago WHERE habilitado=0");
$rf3=cons($consulta3);
while($row3=mysqli_fetch_array($rf3)){
if ($row3['id_tipo_pago']==$id_tipo_pago) {
$opt1='<option value="'.$row3['id_tipo_pago'].'" selected>'.$row3['nombre'].'</option>';
}
$opt2='<option value="'.$row3['id_tipo_pago'].'">'.$row3['nombre'].'</option>';
} 
$coq='<tr id="x'.$id_abono_or.'"><td><input type="text" class="form-control pull-right" name="fecha_pago" value="'.$fecha.'"></td><td><select class="form-control" id="tipo-'.$id_abono_or.'" name="'.$id_tipo_pago.'" style="width: 100%;">'.$opt1.$opt2.'</select></td><td><input type="text" class="form-control" id="n-'.$id_abono_or.'" value='.$n_vaucher.'></td><td><input type="text" class="form-control" id="abono-'.$id_abono_or.'" value='.number_format($monto,2,",",".").'>Bs&nbsp;</td><td>'.strtoupper($persona).'</td><td><button class="btn btn-info glyphicon glyphicon-floppy-saved atc_abono" id="'.$id_abono_or.'"></button></td><td><button class="btn btn-danger glyphicon glyphicon-remove eliminar_abono" id='.$id_abono_or.'></button></td>';

$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br>Resta con IVA:&nbsp;'.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").'&nbsp;Bs</h4>';
?>
<script>
$('#example5 tr:last').after('<?php echo $coq;?>');
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
}	
}	
}	
}	
}
}
}
?>