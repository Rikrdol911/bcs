<?php $conectar=TRUE; include("conexion.php");?>
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
</style>
<style>
#respuesta22{
	position:fixed;
	right:0px;
	bottom:0px;
	z-index:12000000;
	
}
</style>
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['precio_pieza'])){
if(isset($_POST['id_or'])){
if(isset($_POST['id_pieza'])){
$precio1=$_POST['precio_pieza'];
print_r($_POST);
if (is_numeric($precio1)) {

	}else{
		echo negativo("Coloque un precio V&aacute;lido");
		exit;		
	}
	$precio=filtroxss($_POST['precio_pieza']);
$id_or=filtroxss($_POST['id_or']);
$id_pieza=filtroxss($_POST['id_pieza']);
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
$taller=0;
if(isset($_POST['taller'])){
	if($_POST['taller']==1){
		$taller=1;
	$colocar=number_format(($cantidad*$precio),2,",",".");
	$upd=("UPDATE inventario SET precio='$precio' WHERE id_pieza='$id_pieza' AND habilitado='$habilitado'");
	cons($upd);
	}
}
$ins=("UPDATE repuesto_or SET precio='$precio' WHERE id_pieza='$id_pieza' AND habilitado='$habilitado'");
cons($ins);
if($taller==0){
	$colocar=number_format(($cantidad*$precio),2,",",".");
	$upd=("UPDATE inventario SET precio='$precio' WHERE id_pieza='$id_pieza' AND habilitado='$habilitado'");
	cons($upd);
}else{
	$colocar="Traido Por Cliente";
	$precio="Traido Por Cliente";
}

$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';
echo "<div id='respuesta22'>".positivo("se ha actualizado")."</div>";

?>
<script>
$("#totales").html('<?php echo $to;?>');
</script>
<?php
}
}
}
}
}
?>