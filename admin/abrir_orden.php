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
        <li class="active">Abrir OR</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
    <?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id_carro'])){
$n_or1=0;
$consulta_n=("SELECT *,MAX(numero_or) FROM o_r WHERE habilitado=0 LIMIT 1;");
$d_n=cons($consulta_n);
if(mysqli_num_rows($d_n)<=0){
echo negativo("Error con la consulta 1");
}else{
while($row333=mysqli_fetch_array($d_n)){
$n_or1=$row333['MAX(numero_or)'];
$n_or=($n_or1+1);
}
}
$id_carro=filtroxss($_GET['id_carro']);
$consulta=("SELECT * FROM carro WHERE id_carro='$id_carro' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){
echo negativo("No existe el carro seleccionado");
}else{
while($row=mysqli_fetch_array($d)){
$id_cliente=$row['id_cliente'];
$col=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1");
$v=cons($col);
if(mysqli_num_rows($v)<=0){
echo negativo("El dueño del vehiculo no existe en la base de datos");
  exit;
}
while($tr=mysqli_fetch_array($v)){
  $nombre_cliente=$tr['nombre'];
}
echo '<div class="box box-primary">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Abrir Orden de Reparacion para ['.$row['placa'].']</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div></div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_abrir_orden.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Tipo de Documento">Selecciona el Mecanico</label>
                  <select class="form-control" name="id_mecanico" id="tip" required>';
$consul=("SELECT * FROM mecanico WHERE habilitado=0");
$d=cons($consul);
while($f=mysqli_fetch_array($d)){
  echo "<option value='".$f['id_mecanico']."'>".$f['nombre']."</option>";
}

                  echo '</select>
                  <input type="hidden" name="id_carro" value="'.$id_carro.'">
                </div>
                </div>
<div class="col-lg-4 col-md-4 col-xs-10">
                   <div class="form-group">
                    <label for="Tipo de Documento">Dueño Del Vehiculo</label>
                <input type="text" id="dn" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" maxlength="10" value="'.$nombre_cliente.'" readonly>
              </div></div>

<div class="col-lg-4 col-md-4 col-xs-10">
                   <div class="form-group">
                    <label for="Tipo de Documento">N&uacute;mero de OR</label>
                <input type="text" id="dn" class="form-control" placeholder="Ingresa el numero del OR" name="numero_or" value="'.$n_or.'" required>
              </div></div>
              <div class="col-lg-4 col-md-4 col-xs-10">
                   <div class="form-group">
                    <label for="Tipo de Documento">Kilometraje</label>
                <input type="text" id="dn" class="form-control" placeholder="Ingresa el Kilometraje del vehiculo" name="kilometraje" required>
              </div></div>
              <div class="col-lg-4 col-md-4 col-xs-10">
                   <div class="form-group">
                    <label for="Tipo de Documento">IVA %</label>
                <input type="number" id="dn" class="form-control" placeholder="Ingresa el IVA" name="iva" value="12" required>
              </div></div>
              <div class="clearfix"></div>
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Abrir OR</button>
              </div>
              </form></div>
              ';

}
}









}
}

include("footer.php");
?>
