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
if(isset($_POST['precio_mano'])){
if(isset($_POST['id_mano'])){	
if(isset($_POST['id_or'])){
$precio1=$_POST['precio_mano'];

if (!is_numeric($precio1)) {
echo negativo("Coloque un precio V&aacute;lido");
		exit;
	}else{
				
	
$precio=filtroxss($_POST['precio_mano']);
$id_or=filtroxss($_POST['id_or']);
if(($precio=="") || ($id_or=="")){
echo negativo("Uno de los campos esta vacio");
	exit;
}
$id_mano=filtroxss($_POST['id_mano']);
$consulta=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)>=1){
	$ff="0000-00-00";
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND fecha_cierre='$ff' AND habilitado=0 LIMIT 1");
$v=cons($consulta);
while($g=mysqli_fetch_array($v)){
$titulo=unserialize($g['array_titulo']);	
$mano_obra=unserialize($g['array_mano_obra']);
$array_horas=unserialize($g['array_horas']);
$array_precio=unserialize($g['array_precio']);
$array_garantia=unserialize($g['array_garantia']);
$iva=$g['iva'];
}

$indice_titulo = array_search($id_mano,$titulo,false);
$array_precio[$indice_titulo]=$precio;
$guardar=serialize($array_precio);
$upda=("UPDATE o_r SET array_precio='$guardar' WHERE id_or='$id_or' LIMIT 1");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("No se agrego, Intentalo nuevamente");
}else{
	$cosd=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' LIMIT 1");
	$g=cons($cosd);
	while($yy=mysqli_fetch_array($g)){
		$descripcion=$yy['nombre'];
		$id_mano2=$yy['id_mano'];
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
}
}
?>