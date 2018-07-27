<?php include("menu.php");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="fiscal_actual1.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Actual</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->
<!-- Main content -->
<section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['a_fecha'])) {
$fechajuntas1=$_GET['a_fecha'];
$fechasjuntas=trim($fechajuntas1," ");
$separa=explode(" - ",$fechasjuntas);
$fecha1=str_replace("/","-",$separa[0]);
$fecha2=str_replace("/","-",$separa[1]);
$fe=explode("-",$fecha1);
$fecha1=$fe[2]."-".$fe[0]."-".$fe[1];
$fe=explode("-",$fecha2);
$fecha2=$fe[2]."-".$fe[0]."-".$fe[1];
?>
<!-- box-header -->
<div class="box box-primary collapsed-box">
<div class="box-header with-border" data-widget="collapse">
<h3 class="box-title">Resultado fechas del: <?php echo $fecha1." al ".$fecha2; ?><br> &Oacute;denes de Reparaci&oacute;n</h3>
<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
</div>
<div class="box-body">
<?php 
$consulta=("SELECT * FROM o_r WHERE habilitado=0 AND fecha_cierre BETWEEN date('$fecha1') AND date('$fecha2')");
$s=cons($consulta);
if(mysqli_num_rows($s)<=0){
echo alerta("No hay ninguna Orden de Reparaci&oacute;n registrada en las fechas seleccionadas");  
}else{
echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Numero de OR</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Cliente</th>
                  <th>Fecha de Apertura</th>
                 <th>Fecha de Cierre</th>
                </tr>
                </thead>
                <tbody id="prep">';
$cuenta_ordenes=mysqli_num_rows($s);
while($e=mysqli_fetch_array($s)){
$id_or=$e['id_or'];
$numero_or=$e['numero_or'];
$fecha_apertura=$e['fecha_apertura'];
$fecha_cierre=$e['fecha_cierre'];
$id_cliente=$e['id_cliente'];
$id_carro=$e['id_carro'];
echo '<td><a href="detalles_or.php?id_or='.$id_or.'">'.$id_or.'</a></td>';
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
 echo'<td><a href="perfil.php?placa='.$r['id_cliente'].'">'.$r['nombre'].'</a></td>'; 
}
echo '<td>'.$fecha_apertura.'</td>';
if($fecha_cierre=="0000-00-00"){
echo '<td><span class="pull-right badge bg-aqua">Abierta</span></td> </tr>';
}else{
  echo '<td>'.$fecha_cierre.' <span class="pull-right badge bg-danger">Cerrada</span></td> </tr>';
}
}
        echo '</tbody>
                <tfoot>
                <tr>
                       <th>ID</th>
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
<!-- box-header -->
<div class="box box-warning collapsed-box">
<div class="box-header with-border" data-widget="collapse">
<h3 class="box-title">Facutrado Al: <?php echo $fecha1." al ".$fecha2; ?><br> Ventas Facturadas</h3>
<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
</div>
<div class="box-body">
<?php
$consulta2=("SELECT * FROM factura WHERE habilitado=0 AND fecha BETWEEN date('$fecha1') AND date('$fecha2')");
$s=cons($consulta2);
if(mysqli_num_rows($s)<=0){
echo alerta("No hay ninguna Factura registrada");  
$cuenta_ventas=0;
$total_iva=0;
$total_monto=0;
}else{
  echo '<table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>IVA</th>
                  <th>Monto sin IVA</th>
                </tr>
                </thead>
                <tbody id="prep">';
$cuenta_ventas=0;
$total_iva=0;
$total_monto=0;
while($row=mysqli_fetch_array($s)){

$id_factura=$row['id_factura'];
$fecha1=$row['fecha'];
$explo=explode('-', $fecha1);
$fecha=$explo[2]."/".$explo[1]."/".$explo[0];
$id_cliente=$row['id_cliente'];
$iva1=$row['iva'];
$consulta3=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0" );
$s3=cons($consulta3);
$tmontot=0;
while($row3=mysqli_fetch_array($s3)){
$cliente=$row3['nombre'];
$consulta2=("SELECT * FROM detalle_factura WHERE id_factura='$id_factura'");
$s2=cons($consulta2);
$monto_pieza=0;
$tiva=0;
$tmonto=0;
if(mysqli_num_rows($s2)<=0){
echo alerta("Error en consulta 1");  
}else{
while($row2=mysqli_fetch_array($s2)){
$monto11=$row2['monto'];
$cantidad11=$row2['cantidad'];
$monto_pieza2=($monto11*$cantidad11);
$monto_pieza=($monto_pieza+$monto_pieza2);
  
}
$tiva=($monto_pieza*($iva1/100));  
$tmonto=($monto_pieza);
} 
echo '<tr>
<td><a href="perfil_venta.php?id='.$id_factura.'">'.$fecha.'</a></td>
<td><a href="perfil_venta.php?id='.$id_factura.'">'.$id_factura.'</a></td>
<td>'.$cliente.'</td>
<td>'.number_format($tiva,2,",",".").'&nbsp;Bs</td>
<td>'.number_format($tmonto,2,",",".").'&nbsp;Bs</td>
</tr>'; 
$total_iva=($total_iva+$tiva);
$total_monto=($total_monto+$monto_pieza);
}
$cuenta_ventas=($cuenta_ventas+1);
}
echo '</tbody>
<tfoot>
    <tr>
                  <th>Fecha</th>
                  <th>N° Factura</th>
                  <th>Cliente</th>                 
                  <th>IVA</th>
                  <th>Monto</th>
                </tr>
</tfoot>
</table>
</div>
            <!-- /.box-body -->
          </div>';   
}
}
}      
?>
</div>
</div>
<style>
#totales{
position: fixed;
bottom: 0px;
right: 0px;
z-index: 100000000000000;
color:#FFF;
min-height: 25px;
background-color: #0099FF;
}
</style>
<?php
$fechajuntas1=$_GET['a_fecha'];
$fechasjuntas=trim($fechajuntas1," ");
$separa=explode(" - ",$fechasjuntas);
$fecha1=str_replace("/","-",$separa[0]);
$fecha2=str_replace("/","-",$separa[1]);
$fe=explode("-",$fecha1);
$fecha1=$fe[2]."-".$fe[0]."-".$fe[1];
$fe=explode("-",$fecha2);
$fecha2=$fe[2]."-".$fe[0]."-".$fe[1];
$consulta34=("SELECT * FROM o_r WHERE habilitado=0 AND fecha_cierre BETWEEN date('$fecha1') AND date('$fecha2')");
$f34=cons($consulta34);
$todo=0;
$total_or=0;
$total_servicios=0;
$total_repuestos=0;
$todo=0;
$todo2=0;
$todo_iva=0;
$todo2_iva=0;
while($row34=mysqli_fetch_array($f34)){
 $titulo=unserialize($row34['array_titulo']);
 $mano_obra=unserialize($row34['array_mano_obra']);
  $horas=unserialize($row34['array_horas']);
  $precios=unserialize($row34['array_precio']);
  $garantia=unserialize($row34['array_garantia']);
  $id_or_2=$row34['id_or'];
  $iva=$row34['iva'];
foreach($titulo as $numero => $id_mano){
$prec=$precios[$numero];
$garant=$garantia[$numero];
if($garant==0){
  $total_or=($total_or+$prec);
}
  }
$consu=("SELECT * FROM repuesto_or WHERE id_or='$id_or_2' AND habilitado=0");
$co=cons($consu);
while($ro=mysqli_fetch_array($co)){
$cant=$ro['cantidad'];
$prec=$ro['precio'];
$taller=$ro['taller'];
if($taller==0){
$total_repuestos=($total_repuestos+($cant*$prec));
}
}
$consulta=("SELECT * FROM servicios_or WHERE id_or='$id_or_2' AND habilitado=0");
$r=cons($consulta);
while($ros=mysqli_fetch_array($r)){
$total_servicios=($total_servicios+$ros['monto']);
    }
$todo=(($total_or+$total_repuestos)+$total_servicios);
$todo_iva=(($todo*$iva)/100);
$todo2_iva=($todo_iva+$todo_iva);
$todo2=($todo+$todo);
}
 $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
      $fecha_entrada = strtotime("20-08-2018 00:00:00");
      if($fecha_actual < $fecha_entrada){
echo '<div id="totales" class="callout callout-info">
Ventas en el Rango de Fechas:&nbsp;'.$cuenta_ventas.'<br>
<h5>Total Facturado por Ventas:&nbsp;'.number_format($total_monto,2,",",".").'<br>
IVA:&nbsp;'.number_format($total_iva,2,",",".").'</h5>
<hr border="1px" size="20%">
<h5>Total Ordenes:&nbsp;'.$cuenta_ordenes.'<br>
Facturado en Ordenes:&nbsp;'.number_format($todo,2,",",".").'&nbsp;Bs<br>
Mano de Obra:&nbsp;'.number_format($total_or,2,",",".").'&nbsp;Bs<br>
Servicios:&nbsp;'.number_format($total_servicios,2,",",".").'&nbsp;Bs<br>
Repuestos:&nbsp;'.number_format($total_repuestos,2,",",".").'&nbsp;Bs<br>
IVA:&nbsp;'.number_format($todo2_iva,2,",",".").'&nbsp;Bs
<hr/>
Total Facturado por Ventas:&nbsp;'.number_format(($total_monto/100000),2,",",".").'&nbsp;Bs.S<br>
IVA:&nbsp;'.number_format(($total_iva/100000),2,",",".").'</h5>
<hr border="1px" size="20%">
<h5>Total Ordenes:&nbsp;'.$cuenta_ordenes.'<br>
Facturado en Ordenes:&nbsp;'.number_format(($todo/100000),2,",",".").'&nbsp;Bs.S<br>
Mano de Obra:&nbsp;'.number_format(($total_or/100000),2,",",".").'&nbsp;Bs.S<br>
Servicios:&nbsp;'.number_format(($total_servicios/100000),2,",",".").'&nbsp;Bs.S<br>
Repuestos:&nbsp;'.number_format(($total_repuestos/100000),2,",",".").'&nbsp;Bs.S<br>
IVA:&nbsp;'.number_format(($todo2_iva/100000),2,",",".").'&nbsp;Bs.S
</h5>
</div>';

}else {
echo '<div id="totales" class="callout callout-info">
Ventas en el Rango de Fechas:&nbsp;'.$cuenta_ventas.'<br>
<h5>Total Facturado por Ventas:&nbsp;'.number_format($total_monto,2,",",".").'<br>
IVA:&nbsp;'.number_format($total_iva,2,",",".").'</h5>
<hr border="1px" size="20%">
<h5>Total Ordenes:&nbsp;'.$cuenta_ordenes.'<br>
Facturado en Ordenes:&nbsp;'.number_format($todo,2,",",".").'&nbsp;Bs.S<br>
Mano de Obra:&nbsp;'.number_format($total_or,2,",",".").'&nbsp;Bs.S<br>
Servicios:&nbsp;'.number_format($total_servicios,2,",",".").'&nbsp;Bs.S<br>
Repuestos:&nbsp;'.number_format($total_repuestos,2,",",".").'&nbsp;Bs.S<br>
IVA:&nbsp;'.number_format($todo2_iva,2,",",".").'&nbsp;Bs.S</h5>
</div>';
}

?>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<?php 
include("footer.php");
?>