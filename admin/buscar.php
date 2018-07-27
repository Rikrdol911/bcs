<?php $conectar=TRUE; include("conexion.php");
if (isset($_POST['dato'])) {
$dato=filtroxss($_POST['dato']);
$nohay=0;
echo '<h5>B&uacute;squeda&nbsp;de:&nbsp;'.$dato.'</h5><table id="buscador" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Tipo</th>
                  <th>Descripci&oacute;n</th>
				   <th></th>
                  <th></th>
                  <th></th>            			  
                </tr>
                </thead>
                <tbody id="prep">';
$consulta_proveedor=("SELECT * FROM proveedor WHERE habilitado=0 AND (rif LIKE'%$dato%' OR nombre LIKE '%$dato%' OR telf LIKE  '%$dato%')");
$d=cons($consulta_proveedor);
if(mysqli_num_rows($d)<=0){
	$nohay=($nohay+1);
}else{
while($row=mysqli_fetch_array($d)){
$id_tipo=$row['id_tipo'];
$consulta_tipo=("SELECT * FROM tipo WHERE id_tipo='$id_tipo'");
$t=cons($consulta_tipo);
while($rowt1=mysqli_fetch_array($t)){	
echo '<tr><td>Proveedor</td><td>'.$rowt1['nombre'].'-'.$row['rif'].'&nbsp;<a href="perfil_proveedor.php?id='.$row['id_proveedor'].'">&nbsp;'.$row['nombre'].'</a></td><td>'.$row['telf'].'</td><td>'.$row['correo'].'</td></tr>';
}
}
}//else proveedor
//Consulta CLiente
$consulta_cliente=("SELECT * FROM cliente WHERE habilitado=0 AND (dni LIKE '%$dato%' OR nombre LIKE '%$dato%' OR telf LIKE  '%$dato%')");
$c=cons($consulta_cliente);
if(mysqli_num_rows($c)<=0){
	$nohay=($nohay+1);
}else{
while($rowc=mysqli_fetch_array($c)){
$id_tipo=$rowc['id_tipo'];
$consulta_tipo2=("SELECT * FROM tipo WHERE id_tipo='$id_tipo'");
$t2=cons($consulta_tipo2);
while($rowt2=mysqli_fetch_array($t2)){	
echo '<tr><td>Cliente</td><td>'.$rowt2['nombre'].'-'.$rowc['dni'].'&nbsp;<a href="perfil.php?id='.$rowc['id_cliente'].'">'.$rowc['nombre'].'</a></td><td>'.$rowc['telf'].'</td><td>'.$rowc['correo'].'</td></tr>';
}
}
}//Consulta CLiente
//Consulta Pieza
$trozos=explode(" ",$dato); 
   $numero=count($trozos); 
  if ($numero==1) { 
$consulta_pieza=("SELECT * FROM pieza WHERE (nombre LIKE '%$dato%' OR codigo_pieza LIKE '%$dato%' ) AND habilitado=0");
  	}else{
$consulta_pieza=("SELECT * FROM pieza WHERE habilitado=0 AND MATCH(nombre, codigo_pieza) AGAINST('$dato' IN BOOLEAN MODE)");
  	}

$p=cons($consulta_pieza);
if(mysqli_num_rows($p)<=0){
	$nohay=($nohay+1);
}else{
while($rowp=mysqli_fetch_array($p)){
$id_pieza=$rowp['id_pieza'];
$id_rango=$rowp['id_rango'];
$consulta_rango=("SELECT * FROM rango WHERE id_rango='$id_rango'");
$rango=cons($consulta_rango);
while($rowr=mysqli_fetch_array($rango)){	
echo '<tr><td>Pieza</td><td>'.$rowp['codigo_pieza'].'</td><td>'.$rowr['nombre'].'&nbsp;'.$rowp['nombre'].'</td><td>Cantidad:&nbsp;'.cantidad($id_pieza).'</td></tr>';
}
}
}//Consulta Pieza
//Consulta Carro
$consulta_vehiculo=("SELECT * FROM carro WHERE vin LIKE'%$dato%' OR modelo LIKE '%$dato%' OR placa LIKE '%$dato%' OR color LIKE '%$dato%' AND habilitado=0");
$v=cons($consulta_vehiculo);
if(mysqli_num_rows($v)<=0){
	$nohay=($nohay+1);
}else{
while($rowv=mysqli_fetch_array($v)){
$id_carro=$rowv['id_carro'];	
$id_marca=$rowv['id_marca'];
$consulta_marca=("SELECT * FROM marca WHERE id_marca='$id_marca'");
$marca=cons($consulta_marca);
while($rowm1=mysqli_fetch_array($marca)){	
echo '<tr><td>Vehiculo</td><td>'.$rowm1['nombre'].'</td><td>'.$rowv['modelo'].'&nbsp;</td><td>Placa: '.$rowv['placa'].'&nbsp;A&ntilde;o&nbsp;'.$rowv['ano'].'&nbsp;Cilindro:&nbsp;'.$rowv['cilindro'].'&nbsp;Val:&nbsp;'.$rowv['valvula'].'&nbsp;'.$rowv['caja'].'&nbsp;Color&nbsp;'.$rowv['color'].'</td>';
$consulta_o_r=("SELECT * FROM o_r WHERE id_carro='$id_carro'");
$con_o_r=cons($consulta_o_r);
if(mysqli_num_rows($v)<=0){
}else{
while($rowm_o_r=mysqli_fetch_array($con_o_r)){
$id_or=$rowm_o_r['id_or'];	
$numero_or=$rowm_o_r['numero_or'];
$fecha_cierre=$rowm_o_r['fecha_cierre'];
$fecha_apertura=$rowm_o_r['fecha_apertura'];
if ($fecha_cierre=="000-00-00") {
$fecha=$fecha_apertura;
$status='<span class="pull-right badge bg-aqua">Abierta</span>';
}else{
$fecha=$fecha_cierre;
$status='<span class="pull-right badge bg-danger">Cerrada</span>';
}
echo '<td>OR:&nbsp;<a href="detalles_or.php?id_or='.$id_or.'">'.$numero_or.'&nbsp;'.$fecha.'&nbsp;'.$status.'</a></td>';
}
}
echo '</tr>';
}
}
}//Consulta Carro
//Consulta OR 


$consulta_o_r=("SELECT * FROM o_r WHERE numero_or LIKE '%$dato%' AND habilitado=0");
$cor=cons($consulta_o_r);
if(mysqli_num_rows($cor)<=0){
	$nohay=($nohay+1);
}else{
  while($rowcor=mysqli_fetch_array($cor)){
$id_o_r=$rowcor['id_or'];
$id_carro_or=$rowcor['id_carro'];
$id_cliente_or=$rowcor['id_cliente'];
$num_o_r=$rowcor['numero_or'];
$consulta_clie2=("SELECT * FROM cliente WHERE id_cliente='$id_cliente_or'");
$t22=cons($consulta_clie2);
while($rowt22=mysqli_fetch_array($t22)){ 
$nombre_cliente=$rowt22['nombre'];
$consulta_carro2=("SELECT * FROM carro WHERE id_carro='$id_carro_or'");
$t222=cons($consulta_carro2);
while($rowt222=mysqli_fetch_array($t222)){ 
$modelo_carro=$rowt222['modelo'];
$ano2=$rowt222['ano'];
$placa2=$rowt222['placa'];
$caja2=$rowt222['caja'];
$color2=$rowt222['color'];
echo '<tr><td>OR:&nbsp;<a href="detalles_or.php?id_or='.$id_o_r.'">'.$num_o_r.'</a></td><td><a href="detalles_or.php?id_or='.$id_o_r.'">'.$modelo_carro.'-'.$caja2.'&nbsp;'.$ano2.'</a></td><td>'.$color2.'</td><td>'.$nombre_cliente.'</td></tr>';
}
}
}
}//Consulta OR
echo '</tbody></table>';
}else{
echo '<td>Debes Igresar al menos un Dato</td></tbody></table>';
}
if($nohay==5){
	echo alerta("No se encontro resultados");
}
?>