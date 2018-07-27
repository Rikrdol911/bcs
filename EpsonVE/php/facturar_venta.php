<?php $conectar=TRUE; include("../../admin/conexion.php");
?>
<style>
body{
	margin:.0px;
	padding:.0px;
	font-family:Arial, Helvetica, sans-serif;
	margin-left: 5px;
}
#contenido{
	width: 831px;
	height: 937.32px;
}
#cabecera{
	width: 100%;
	height: 206px;
}
#nombre{
	width: 100%;
}
#nombre tr td{
height:30.23px;
}
.blanco{
	color: #FFF;
	font-size: 12px;
}
#pr{
	width: 548px;
}
#dir{
	width: 100%;
}
table{
	cellpadding:0px;
	cellspacing:0px;
}
.prs{
height:30.23px;	
}
.jj{
	width: 442.20px;
	 vertical-align: text-top;  
}
</style>
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id_factura'])){
if(isset($_POST['tipo'])){
if(isset($_POST['dni'])){	
if(isset($_POST['nombre'])){
if(isset($_POST['direccion'])){	
$id_factura=filtroxss($_POST['id_factura']);  
$consulta=("SELECT * FROM factura WHERE id_factura='$id_factura' AND habilitado=0 AND imp=1 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)>0){
echo "Error 001";
exit; 
}else{
$nombre_cliente=filtroxss($_POST['nombre']); 
$dni=filtroxss($_POST['dni']);   
$id_tipo=filtroxss($_POST['tipo']); 
$consulta3p=("SELECT * FROM tipo WHERE id_tipo='$id_tipo'");
$s3p=cons($consulta3p);
while($row3p=mysqli_fetch_array($s3p)){
$nombre_tipo=$row3p['nombre'];
} 
$consultaqq=("SELECT * FROM factura WHERE id_factura='$id_factura' AND habilitado=0 LIMIT 1");
$fq=cons($consultaqq);
while($rtg=mysqli_fetch_array($fq)){
	$id_delcl=$rtg['id_cliente'];
}
$cof=("SELECT telf FROM cliente WHERE id_cliente='$id_delcl' LIMIT 1");
$as=cons($cof);
while($fgv=mysqli_fetch_array($as)){
	$telefo=$fgv['telf'];
}
echo "<div id='contenido'>";
echo "<div id='cabecera'></div>";
echo "<table id='nombre' cellpadding='0' cellspacing='0'>
<tr><td id='pr'><i class='blanco'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>".$nombre_cliente."</td><td><i class='blanco'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> ".date("d-m-Y")."</td></tr></table>";
echo '<table id="dir" cellpadding="0" cellspacing="0">
<tr>
 <td rowspan="4" class="prs jj">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$_POST['direccion'].'</td>
  <td class="prs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$nombre_tipo.'-'.number_format($dni,0,".",".").'</td>
</tr>
<tr>
  <td class="prs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$telefo.'</td>
</tr>
<tr>
  <td class="prs"></td>
</tr>
<tr>
  <td class="prs"></td>
</tr>
</table>';
$consulta=("SELECT * FROM factura WHERE id_factura='$id_factura' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
echo "Error 002";
exit; 
}else{
while($row0=mysqli_fetch_array($f)){
$iva1=$row0['iva'];
$iva=($iva1*100);
}
$consulta2=("SELECT * FROM detalle_factura WHERE id_factura='$id_factura'");
$s2=cons($consulta2);
if(mysqli_num_rows($s2)<=0){
echo "Error 003";
}else{
?>
<style>
#cf{
	width: 100%;
}
#codf{
	width: 71.81px;
}
#dos{
	width: 370.39px;
}
#tres{
width: 60.47px;	
}
#cuatro{
	width: 94.48px;
}
#cinco{
	width: 34.01px;
}
#seis{
	width: 124.72px;

}
#codf1{
	width: 71.81px;
	height: 37.79px;
}
#dos1{
	width: 370.39px;
	height: 37.79px;
}
#tres1{
width: 60.47px;	
height: 37.79px;
}
#cuatro1{
	width: 94.48px;
	height: 37.79px;
}
#cinco1{
	width: 34.01px;
	height: 37.79px;
}
#seis1{
	width: 124.72px;
	height: 37.79px;
}
</style>
<?php
echo "<table id='cf' cellpadding='0' cellspacing='0'>
<tr>
<td id='codf'>&nbsp;</td>
<td id='dos'>&nbsp;</td>
<td id='tres'>&nbsp;</td>
<td id='cuatro'>&nbsp;</td>
<td id='cinco'>&nbsp;</td>
<td id='seis'>&nbsp;</td>
</tr>";
$contador=0;
$sumador=0;
while($row2=mysqli_fetch_array($s2)){
$monto=$row2['monto'];
$cantidad=$row2['cantidad'];
$id_pieza=$row2['id_pieza'];
$consulta3=("SELECT * FROM pieza WHERE id_pieza='$id_pieza'");
$s3=cons($consulta3);
if(mysqli_num_rows($s3)<=0){
echo "Error en consulta 001";
}else{
while($row3=mysqli_fetch_array($s3)){ 
$nombre_pieza=$row3['nombre'];
$codigo=$row3['codigo_pieza'];
echo "<tr>
<td id='codf1'><small><small><small>".$codigo."</small></small></small></td>
<td id='dos1'><center>".$nombre_pieza."</center></td>
<td id='tres1'><center>".$cantidad."</center></td>
<td id='cuatro1'><center>".number_format($monto,2,",",".")."</center></td>
<td id='cinco1'>&nbsp;</td>
<td id='seis1'><center>".number_format(($monto*$cantidad),2,",",".")."</center></td>
</tr>";
$sumador=($sumador+($monto*$cantidad));
}
}
$contador=($contador+1);
}
$cuantas=(13-$contador);
if(($contador>=1 && $contador<13)){
	for($i=1; $i<=$cuantas; $i++){
	echo "<tr>
<td id='codf1'></td>
<td id='dos1'></td>
<td id='tres1'></td>
<td id='cuatro1'></td>
<td id='cinco1'>&nbsp;</td>
<td id='seis1'></td>
</tr>";	
	}
}

echo "</table>";
}

}
?>
<style>
#cfa{
	width: 100%;
}
#sd{
	width: 300.78px;
}
#sd2{
	width: 245.66px;
}
.s3{
	width: 141.62px;
		height: 22.67px;
}
.s4{
		height: 26.45px;
}
</style>
<?php
$ivas=(($sumador*$iva1)/100);
echo "<table id='cfa' cellpadding='0' cellspacing='0'>
<tr>
  
  <td id='sd' rowspan='4'>&nbsp;</td>
  <td id='sd2' rowspan='4'>&nbsp;</td>
  <td class='s3'>&nbsp;</td><td></td>
</tr>
 
<tr>
  <td class='s3'>&nbsp;</td><td><center>".number_format($sumador,2,",",".")."</center></td>
</tr><tr>
  <td class='s3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$iva1."</td><td><center>".number_format($ivas,2,",",".")."</center></td>
</tr><tr>
  <td class='s4'></td><td><center>".number_format(($sumador+$ivas),2,",",".")."</center></td>
</tr><tr>
  <td colspan='2'></td> <td></td><td></td>
</tr>

";



echo '</div>';
}
}
}
}
}
}
}
?>
