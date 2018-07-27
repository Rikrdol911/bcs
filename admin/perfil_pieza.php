<?php include("menu.php");?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="registrar_carro.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Veh&iacute;culo de Cliente</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id'])){
$id_pieza=filtroxss($_GET['id']);
$consulta=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
	echo alerta("Ha ocurrido un error en la consulta");	
	}else{

while ($row=mysqli_fetch_array($f)) {
$codigo_pieza=$row['codigo_pieza'];
$nombre_pieza=$row['nombre'];
$id_rango=$row['id_rango'];
$consulta2=("SELECT * FROM rango WHERE id_rango='$id_rango' AND habilitado=0 LIMIT 1");
$f2=cons($consulta2);
if(mysqli_num_rows($f2)<=0){
	echo alerta("Ha ocurrido un error en la consulta");	
}else{
while ($row2=mysqli_fetch_array($f2)) {
$nombre_rango=$row['nombre'];
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>&nbsp;'.$codigo_pieza.'&nbsp;'.$nombre_pieza.'<br>&nbsp;Disponible:&nbsp;'.cantidad($id_pieza).'</b></h3>
            </div>
            <!-- /.box-header -->';

}
}
	}
$consulta3=("SELECT * FROM inventario WHERE id_pieza='$id_pieza' AND habilitado=0");
$f3=cons($consulta3);
if(mysqli_num_rows($f3)<=0){
}else{
echo '<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>N° Fact.</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Proveedor</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
while($row3=mysqli_fetch_array($f3)){
$n_factura=$row3['n_factura'];
$fecha=$row3['fecha'];
$id_proveedor=$row3['id_proveedor'];
$cantidad=$row3['cantidad'];
$precio=$row3['precio'];
$consu=("SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor' LIMIT 1");
$dv=cons($consu);
while($ro=mysqli_fetch_array($dv)){
$id_tipo=$ro['id_tipo'];
$nombre_proveedor=$ro['nombre'];
$rif=$ro['rif'];	
$telefono=$ro['telf'];	
$consu2=("SELECT * FROM tipo WHERE id_tipo='$id_tipo' LIMIT 1");
$dv2=cons($consu2);
while($ro2=mysqli_fetch_array($dv2)){
$nombre_tipo=$ro2['nombre'];
echo '<tr><td><a href="facturas.php?n_fac='.$n_factura.'&id_proveedor='.$id_proveedor.'">'.$fecha.'</a></td>
<td><a href="facturas.php?n_fac='.$n_factura.'&id_proveedor='.$id_proveedor.'">'.$n_factura.'</a></td>
<td>'.$cantidad.'</td>
<td>'.$precio.'</td>
<td>'.$nombre_tipo.'-'.$rif.'&nbsp;'.$nombre_proveedor.'</td></tr>';
}
}
}

echo '</tbody></table></div>
            <!-- /.box-body -->
          </div>';
}

	}
}
?>
<?php
$consulta2=("SELECT * FROM detalle_factura WHERE id_pieza='$id_pieza'");
$s3=cons($consulta2);
$monto_pieza=0;
$tiva=0;
$tmonto=0;
if(mysqli_num_rows($s3)<=0){
echo alerta("No hay ninguna venta registrada");  
}else{

          echo '<div class="box box-warning box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Salidas Por Ventas</h3>

              <div class="box-tools pull-right ">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>Monto de Venta Seg&uacute;n Fact</th>
                  
                </tr>
                </thead>
                <tbody id="prep">';
$monto_pieza=0;
$monto_pieza2=0;
$tiva=0;
$tmonto=0;
while($row3=mysqli_fetch_array($s3)){
$id_factura=$row3['id_factura'];
$monto11=$row3['monto'];
$cantidad11=$row3['cantidad'];
$monto_pieza2=($monto11*$cantidad11);
$monto_pieza=($monto_pieza+$monto_pieza2);
 $consulta4=("SELECT * FROM factura WHERE habilitado=0 AND id_factura='$id_factura'");
 $s4=cons($consulta4);
 if(mysqli_num_rows($s4)<=0){
}else{
while($row4=mysqli_fetch_array($s4)){
$id_factura=$row4['id_factura'];
$fecha1=$row4['fecha'];
$explo=explode('-', $fecha1);
$fecha=$explo[2]."/".$explo[1]."/".$explo[0];
$id_cliente=$row4['id_cliente'];
$iva1=$row4['iva'];
$consulta5=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0" );
$s5=cons($consulta5);
while($row5=mysqli_fetch_array($s5)){
$cliente=$row5['nombre'];
}
$tiva=($monto_pieza*($iva1/100));  
$tmonto=($monto_pieza);
echo '<tr>
<td><a href="perfil_venta.php?id='.$id_factura.'">'.$fecha.'</a></td>
<td><a href="perfil_venta.php?id='.$id_factura.'">'.$id_factura.'</a></td>
<td>'.$cliente.'</td>
<td>'.number_format($tmonto,2,",",".").'&nbsp;Bs</td>
</tr>'; 

      }//while Factura

 }

}//While Detalle Factura

        
      echo '</tbody>
<tfoot>
    <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>Monto de Venta Seg&uacute;n Fact</th>
                </tr>
</tfoot>
</table>
</div>
            <!-- /.box-body -->
          </div>';  
    
   } 
?>
<?php
$consulta6=("SELECT * FROM repuesto_or WHERE id_pieza='$id_pieza' AND habilitado=0");
$s6=cons($consulta6);
$monto_pieza=0;
$tiva=0;
$tmonto=0;
if(mysqli_num_rows($s6)<=0){
echo alerta("No hay Salida de Pieza por Orden");  
}else{

          echo '          <div class="box box-warning box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Salidas Por Orden</h3>

              <div class="box-tools pull-right ">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Numero de OR</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Cliente</th>
                  <th>Fecha de Apertura</th>
                 <th>Fecha de Cierre</th>
                  
                </tr>
                </thead>
                <tbody id="prep">';
while($row6=mysqli_fetch_array($s6)){
$id_or=$row6['id_or'];
 $consulta7=("SELECT * FROM o_r WHERE habilitado=0 AND id_or='$id_or'");
 $s7=cons($consulta7);
 if(mysqli_num_rows($s7)<=0){
}else{
while($row7=mysqli_fetch_array($s7)){
$numero_or=$row7['numero_or'];
$fecha_apertura=$row7['fecha_apertura'];
$fecha_cierre=$row7['fecha_cierre'];
$id_cliente=$row7['id_cliente'];
$id_carro=$row7['id_carro'];
echo '<td><a href="detalles_or.php?id_or='.$id_or.'">'.$numero_or.'</a></td>';
$consult=("SELECT * FROM carro WHERE id_carro='$id_carro' LIMIT 1");
$ds=cons($consult);
while($r=mysqli_fetch_array($ds)){
 echo'<td><a href="perfil_carro.php?placa='.$r['placa'].'">'.$r['modelo'].'</a></td>'; 
 echo'<td><a href="perfil_carro.php?placa='.$r['placa'].'">'.$r['placa'].'</a></td>'; 
}
$consult=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' LIMIT 1");
$ds=cons($consult);
while($r=mysqli_fetch_array($ds)){
 echo'<td><a href="perfil.php?id='.$r['id_cliente'].'">'.$r['nombre'].'</a></td>'; 
}
echo '<td>'.$fecha_apertura.'</td>';

      }//while OR
if($fecha_cierre=="0000-00-00"){
echo '<td><span class="pull-right badge bg-aqua">Abierta</span></td></tr>';
}else{
  echo '<td><small>'.$fecha_cierre.'</small><span class="pull-right badge bg-danger">Cerrada</span></td> </tr>';
}
 }

}//While respuesto OR

        
      echo '</tbody>
<tfoot>
    <tr>
                 <th>Numero de OR</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Cliente</th>
                  <th>Fecha de Apertura</th>
                 <th>Fecha de Cierre</th>
                </tr>
</tfoot>
</table>
</div>
            <!-- /.box-body -->
          </div>';  
    
   } 
?>
</section>
</div>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php
include("footer.php");
}
?>