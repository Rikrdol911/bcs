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
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ordenes De Reparacion</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
     <?php
if(isset($_SESSION['ingreso'])){

echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><a href="registrar_carro.php">Abrir nueva OR [+]</a></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool">
                </button>
              </div></div>
              </div>

              ';


$consulta=("SELECT * FROM o_r WHERE habilitado=0");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){

echo negativo("No has realizado ninguna Orden de Reparacion");
}else{
    echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">OR Registradas</h3>
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Numero de OR</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Cliente</th>
                  <th>Descripci&oacute;n</th>
                  <th>Fecha de Apertura</th>
                 <th>Fecha de Cierre</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
   while($e=mysqli_fetch_array($d)){
$id_or=$e['id_or'];
$numero_or=$e['numero_or'];
$fecha_apertura=$e['fecha_apertura'];
$fecha_cierre=$e['fecha_cierre'];
$id_cliente=$e['id_cliente'];
$id_carro=$e['id_carro'];
$titulo=unserialize($e['array_titulo']);
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
echo '<td>';
  //aqui iban muchos td... pero los elimine
foreach($titulo as $numero => $id_mano){
$consd=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' LIMIT 1");
$df=cons($consd);
while($fg=mysqli_fetch_array($df)){
  $nombre_mano=$fg['nombre'];
}

echo '<small>- '.$nombre_mano.'</small><br>';

}echo '</td>';
echo '<td><small>'.$fecha_apertura.'</small></td>';
if($fecha_cierre=="0000-00-00"){
echo '<td><span class="pull-right badge bg-aqua">Abierta</span></td></tr>';
}else{
  echo '<td><small>'.$fecha_cierre.'</small><span class="pull-right badge bg-danger">Cerrada</span></td> </tr>';
}

}
        echo '</tbody>
                <tfoot>
                <tr>              
                  <th>Numero de OR</th>
                  <th>Vehiculo</th>
                  <th>Placa</th>
                  <th>Cliente</th>
                  <th>Descripci&oacute;n</th>
                  <th>Fecha de Apertura</th>
                 <th>Fecha de Cierre</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>';



}




  }
  ?>
<script>
  $(function () {
    $("#example1").DataTable();
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
?>