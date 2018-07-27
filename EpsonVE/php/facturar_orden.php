<?php $conectar=TRUE; include("../../admin/conexion.php");?>
<style>
body{
  margin:.0px;
  padding:.0px;
  font-family:Arial, Helvetica, sans-serif;
}
#contenido{
  width: 831px;
  height: 937.32px;
}
#cabecera{
  width: 100%;
  height: 130px;
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
if(isset($_POST['id_or'])){
if(isset($_POST['tipo'])){
if(isset($_POST['dni'])){	
if(isset($_POST['nombre'])){
if(isset($_POST['direccion'])){ 
$id_or=filtroxss($_POST['id_or']);
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 AND imp=1 LIMIT 1");  
$f=cons($consulta);
if(mysqli_num_rows($f)>0){
echo "Error en consulta 001";
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
$consultaqq=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
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
<tr><td id='pr'><i class='blanco'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>".$nombre_cliente."</td><td><i class='blanco'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> ".date("d-m-Y")."</td></tr></table>";
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
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$f=cons($consulta);
$tmano=0;
while($row=mysqli_fetch_array($f)){
  $titulo=unserialize($row['array_titulo']);
  $mano_obra=unserialize($row['array_mano_obra']);
  $horas=unserialize($row['array_horas']);
  $precios=unserialize($row['array_precio']);
  $garantia=unserialize($row['array_garantia']);
  $iva1=$row['iva'];
  $iva=($iva1*100);
if (isset($titulo)) {
if ($titulo!=="") {
foreach($titulo as $numero => $id_mano){
$consd=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano'");
$df=mysqli_query($_SESSION['conexion_database'],$consd) or die(mysqli_error($_SESSION['conexion_database']));
while($fg=mysqli_fetch_array($df)){
$precios[$numero];
$precio=$precios[$numero];
$garant=$garantia[$numero];
if ($garant==1) {
$precio=0;
 }
$tmano=($tmano+$precio);
}
}
}
}
}
}
if($tmano!=0){
  echo "<tr>
<td id='codf1'><small><small><small>MO-1147</small></small></small></td>
<td id='dos1'><center>SERVICIO TECNICO (MANO DE OBRA)</center></td>
<td id='tres1'><center>1</center></td>
<td id='cuatro1'><center>".number_format($tmano,2,",",".")."</center></td>
<td id='cinco1'>&nbsp;</td>
<td id='seis1'><center>".number_format(($tmano*1),2,",",".")."</center></td>
</tr>";
$contador=($contador+1);
$sumador=($sumador+$tmano);
}
$consu=("SELECT * FROM repuesto_or WHERE id_or='$id_or' AND habilitado=0");
$p1=mysqli_query($_SESSION['conexion_database'],$consu) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($p1)<=0){
}else{
while($ro=mysqli_fetch_array($p1)){
$id_pie=$ro['id_pieza'];
$cantidad=$ro['cantidad'];
$prec=$ro['precio'];
$taller=$ro['taller'];
if($taller==1){
$prec=0;
}else{
$monto=$prec;
$cod1=("SELECT * FROM pieza WHERE id_pieza='$id_pie' LIMIT 1");
$p2=mysqli_query($_SESSION['conexion_database'],$cod1) or die(mysqli_error($_SESSION['conexion_database']));
while($f=mysqli_fetch_array($p2)){
$nombre_pieza=$f['nombre'];
$codigo=$f['codigo_pieza'];
  echo "<tr>
<td id='codf1'><small><small><small>".$codigo."</small></small></small></td>
<td id='dos1'><center>".$nombre_pieza."</center></td>
<td id='tres1'><center>".$cantidad."</center></td>
<td id='cuatro1'><center>".number_format($prec,2,",",".")."</center></td>
<td id='cinco1'>&nbsp;</td>
<td id='seis1'><center>".number_format(($prec*$cantidad),2,",",".")."</center></td>
</tr>";
$contador=($contador+1);
$sumador=($sumador+($prec*$cantidad));
}	
}	
}
}
$consultaservicios=("SELECT * FROM servicios_or WHERE id_or='$id_or'");
$se=mysqli_query($_SESSION['conexion_database'],$consultaservicios) or die(mysqli_error($_SESSION['conexion_database']));
if(mysqli_num_rows($se)<=0){ 
}else{
$tservicio=0;
while($ros=mysqli_fetch_array($se)){
$monto_servicio=$ros['costo_servicio'];
$tservicio=($tservicio+$monto_servicio);
}
if($monto_servicio!=0){
   echo "<tr>
<td id='codf1'><small><small><small>SER-1145</small></small></small></td>
<td id='dos1'><center>SERVICIO</center></td>
<td id='tres1'><center>1</center></td>
<td id='cuatro1'><center>".number_format($monto_servicio,2,",",".")."</center></td>
<td id='cinco1'>&nbsp;</td>
<td id='seis1'><center>".number_format(($monto_servicio*1),2,",",".")."</center></td>
</tr>"; 
$sumador=($sumador+$monto_servicio);
$contador=($contador+1);
}
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
} 	
}
}
}
}
}
echo "</div>";
?>