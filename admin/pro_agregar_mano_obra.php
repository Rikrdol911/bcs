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
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['horas'])){
if(isset($_POST['precio'])){
if(isset($_POST['id_mano'])){	
if(isset($_POST['id_or'])){
$horas=filtroxss($_POST['horas']);
$precio1=$_POST['precio'];
if (is_numeric($precio1)) {

	}else{
		echo negativo("Coloque un precio V&aacute;lido");
		exit;		
	}
$precio=filtroxss($_POST['precio']);
$id_or=filtroxss($_POST['id_or']);
if(($horas=="") || ($precio=="") || ($id_or=="")){
echo negativo("Uno de los campos esta vacio");
	exit;
}

if(!isset($_POST['id_descripcion'])){	
$id_descripcion=array();
}else{
$id_descripcion=$_POST['id_descripcion'];
}
if(isset($_POST['garantia'])){
	$garantia=$_POST['garantia'];
	if($garantia==1){

	}else{
		$garantia=0;
	}
}else{
	$garantia=0;
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
if (in_array($id_mano, $titulo)) {
    echo negativo("Ya la mano de obra fue agregada previamente");
    exit;
}
array_push($titulo,$id_mano);
array_push($mano_obra,$id_descripcion);
array_push($array_horas,$horas);
array_push($array_precio,$precio);
array_push($array_garantia,$garantia);
$mano=serialize($mano_obra);
$hors=serialize($array_horas);
$prec=serialize($array_precio);
$gar=serialize($array_garantia);
$titu=serialize($titulo);
$upda=("UPDATE o_r SET array_mano_obra='$mano', array_titulo='$titu', array_horas='$hors', array_precio='$prec', array_garantia='$gar' WHERE id_or='$id_or' LIMIT 1");
$d=cons($upda);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("No se agrego, Intentalo nuevamente");
}else{
	$cosd=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' LIMIT 1");
	$g=cons($cosd);
	while($yy=mysqli_fetch_array($g)){
		$descripcion=$yy['nombre'];
	}
	if($garantia==0){
		$vs="No";
	}else{
		$vs="Si";
	}
	$coq="<tr id=".'a'.$id_mano."><td>".$id_mano."</td><td>".$descripcion."<br><small>Items Adicionales, seran mostrados al actualizar la pagina</small></td><td>".$horas."</td><td>".$precio." Bs</td><td>".$vs."</td><td><button class=".'eliminar'." id=".$id_mano.">X</button></td></tr>";

$to='<h4>Sub-Total&nbsp;:&nbsp;'.number_format(total_or($id_or),2,",",".").'&nbsp;Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br>&nbsp;Resta Sin IVA:&nbsp;'.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br> Resta con IVA: '.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").' Bs</h4>';

?>
<script>
$('#example1 tr:first').after('<?php echo $coq;?>');
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