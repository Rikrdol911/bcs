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
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#respuesta22").fadeOut(4500);
    },5000);
});
</script>
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_abono_or'])){
if(isset($_POST['monto'])){
if(isset($_POST['id_or'])){
if(isset($_POST['n_vaucher'])){
if(isset($_POST['id_tipo_pago'])){
$monto1=$_POST['monto'];
if (!is_numeric($monto1)) {
echo "<div id='respuesta22'>".negativo("Coloque un precio Valido")."</div>";
        exit;
    }else{
$monto=filtroxss($_POST['monto']);
$id_or=filtroxss($_POST['id_or']);  
$id_abono_or=filtroxss($_POST['id_abono_or']);
$id_tipo_pago=filtroxss($_POST['id_tipo_pago']);
$n_vaucher=filtroxss($_POST['n_vaucher']);  
if(($monto=="") || ($id_or=="") || ($id_abono_or=="")|| ($n_vaucher=="") || ($id_tipo_pago=="")){
echo negativo("Uno de los campos esta vacio");
    exit;
}
$cons=("SELECT * FROM abono_or WHERE id_or='$id_or' AND id_tipo_pago='$id_tipo_pago' AND n_vaucher='$n_vaucher' AND monto='$monto' AND habilitado=0 LIMIT 1");
$d=cons($cons);
if(mysqli_num_rows($d)>=1){
    echo negativo("Debes Realizar al Menos un Cambio");
    exit;
}else{
$upd=("UPDATE abono_or SET monto='$monto',n_vaucher='$n_vaucher',id_tipo_pago='$id_tipo_pago' WHERE id_abono_or='$id_abono_or' AND id_or='$id_or' AND habilitado=0");
    cons($upd);

}
$consulta2=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
$f2=cons($consulta2);
while($row2=mysqli_fetch_array($f2)){
  $id_or=$row2['id_or'];
  $iva=$row2['iva'];
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