<?php include("menu.php");
?>
<?php 
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id_or'])){
$id_or=$_GET['id_or'];
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
        <li><a href="detalles_or.php?id_or=<?php echo $id_or; ?>"><i class="fa fa-dashboard"></i> Volver a Orden</a></li>
        <li class="active">Editar Orden</li>
      </ol>
    </section>
    <section class="content">
<?php
$consulta_n=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1;");
$d_n=cons($consulta_n);
if(mysqli_num_rows($d_n)<=0){
echo negativo("Error con la consulta de Orden");
}else{
while($row333=mysqli_fetch_array($d_n)){
$id_mecanico=$row333['id_mecanico'];
$km=$row333['kilometros'];
$id_carro=$row333['id_carro'];
$id_cliente=$row333['id_cliente'];
$iva=$row333['iva'];
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Orden De Reparacion <b>['.$row333['numero_or'].']</b>&nbsp;</h3><hr>';
$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1"); 
$ds=cons($consulta);
while($g=mysqli_fetch_array($ds)){
  echo "<b>Cliente: </b><a href='perfil.php?id=".$g['id_cliente']."'>".$g['nombre']."</a>";
}
$con=("SELECT * FROM carro WHERE id_carro='$id_carro' AND habilitado=0 LIMIT 1");
$d=cons($con);
if(mysqli_num_rows($d)<=0){
echo negativo("No existe el carro");
  exit;
}
while($f=mysqli_fetch_array($d)){
  echo "<br><b>Vehiculo: </b><a href='perfil_carro.php?placa=".$f['placa']."'>".$f['modelo']." - ".$f['placa']."</a>";
}
$consulta2=("SELECT * FROM mecanico WHERE id_mecanico='$id_mecanico' AND habilitado=0 LIMIT 1");
      $s2=cons($consulta2);
      if(mysqli_num_rows($s2)<=0){
      echo alerta("No hay ningun Mec&aacute;nico registrado");  
      }else{
while($f2=mysqli_fetch_array($s2)){
$nombre_mecanico=$f2['nombre'];
echo "<br><b>Mecanico Asignado:</b>&nbsp;".$nombre_mecanico."";
}
echo '<hr><!-- Mecanico -->
<form id="formulario" class="form-group tex" action="pro_edit_or.php" method="POST">
          <div class="col-lg-4 col-md-4 col-xs-10 text-center">
          <div class="form-group">
                  <label for="Tipo de Documento">Actualizar Mecanico</label>
                  <select class="form-control" name="nid_mecanico" required>'; 
$consulta=("SELECT * FROM mecanico");
$d=cons($consulta);
while($row=mysqli_fetch_array($d)){
echo "<option value=".$row['id_mecanico'].">".$row['nombre']."</option>"; 
}
              echo '</select>
                </div>
                </div>';
echo '<div class="col-lg-4 col-md-4 col-xs-10 text-center">
          <div class="form-group">
          <label for="Tipo de Documento">Actualizar KM</label>
<input type="text" class="form-control" name="nkm" value="'.$km.'" placeholder="Ingrese km del Veh&iacute;culo" required>

</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-10 text-center">
          <div class="form-group">
          <label for="Tipo de Documento">IVA %</label>
<input type="text" class="form-control" name="iva" value="'.$iva.'" placeholder="Ingrese IVA" required>

</div>
</div>
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="form-group text-center">
<input type="hidden" name="id_or" value="'.$id_or.'">
<button class="btn btn-primary" type="submit">Actualizar</button>
</div>
</div>';

}
echo '</div></div></form>';
}
}
?>
</section>
<script>
  $(document).ready(function(){
       $('#formulario').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            async: true,   
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {

                $('#respuesta').html(data);
                 
            }
        })        
        return false;
    }); 
    });
    </script>
<?php
}
}
include("footer.php");
?>