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
        <li class="active">Mec&aacute;nicos</li>
      </ol>
</section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
    <?php
if(isset($_SESSION['ingreso'])){
	echo '<div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Registrar Mec&aacute;nico</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_mecanico.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Tipo de Documento">Documento</label>
                  <select class="form-control" name="tipo" required>';

$consulta=("SELECT * FROM tipo");
$d=cons($consulta);
while($row=mysqli_fetch_array($d)){
echo "<option value=".$row['id_tipo'].">".$row['nombre']."</option>";	
}
              echo '</select>
                </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-xs-10">
				<div class="form-group">
                  <label for="Documento">Documento</label>
                  <input type="text" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" maxlength="10" required>
                </div>
                </div>
                <!-- /. Documento Nacional de Identidad -->

                <!-- Nombre de Mecanico -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del Mec&aacute;nico" name="nombre" required>
                </div>
                </div>
                <!-- /. Nombre de Mecanico -->
               <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Registrar Mec&aacute;nico</button>
              </div>
              <!-- /.btn envio -->

            </form>
            <!-- /.formulario cliente -->
          </div>
          </div>
              <!-- /.box-body -->';
		  echo "<div id='clearfix'></div>";
                $consult=("SELECT * FROM tipo");
		  $d=cons($consult);
		  $ti=array();
		  while($fg=mysqli_fetch_array($d)){
			  $ti[$fg['id_tipo']]=$fg['nombre'];
		  }
 $consulta=("SELECT * FROM mecanico WHERE habilitado=0");
		  $s=cons($consulta);
		  if(mysqli_num_rows($s)<=0){
			echo alerta("No hay ningun Mec&aacute;nico registrado");  
		  }else{
  echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Trabajos de Mec&aacute;nicos</h3>
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N&uacute;mero de OR</th>
                  <th>Mec&aacute;nico</th>
                  <th>Modelo</th>
                  <th>Placa</th>
                  
                  <th>Fecha Apertura</th>
                  <th>Fecha Cierre</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
while($row=mysqli_fetch_array($s)){
$id_mecanico=$row['id_mecanico'];
$nombre_mecanico=$row['nombre'];
$consulta1=("SELECT * FROM o_r WHERE id_mecanico='$id_mecanico' AND habilitado=0");
$d=cons($consulta1);	
if(mysqli_num_rows($d)<=0){

}else{
   while($e=mysqli_fetch_array($d)){
$id_or=$e['id_or'];
$numero_or=$e['numero_or'];
$fecha_apertura=$e['fecha_apertura'];
$fecha_cierre=$e['fecha_cierre'];
$id_cliente=$e['id_cliente'];
$id_carro=$e['id_carro'];
echo '<td><a href="detalles_or.php?id_or='.$id_or.'">'.$numero_or.'</a></td>';
echo '<td><a href="edit_meca.php?id_mecanico='.$id_mecanico.'">'.$nombre_mecanico.'</a></td>';    
$consult=("SELECT * FROM carro WHERE id_carro='$id_carro' LIMIT 1");
$ds=cons($consult);
while($r=mysqli_fetch_array($ds)){
 echo'<td><a href="perfil_carro.php?placa='.$r['placa'].'">'.$r['modelo'].'</a></td>'; 
 echo'<td><a href="perfil_carro.php?placa='.$r['placa'].'">'.$r['placa'].'</a></td>'; 
}//WHile Carro	
echo '<td>'.$fecha_apertura.'</td>';
if($fecha_cierre=="0000-00-00"){
echo '<td><span class="pull-right badge bg-aqua">Abierta</span></td> </tr>';
}else{
  echo '<td>'.$fecha_cierre.' <span class="pull-right badge bg-danger">Cerrada</span></td> </tr>';
}

}


   }//while OR	

}
echo '</tbody>
                <tfoot>
                <tr>
                <th>N&uacute;mero de OR</th>
                  <th>Modelo</th>
                  <th>Placa</th>
                  <th>Mec&aacute;nico</th>
                  <th>Fecha Apertura</th>
                  <th>Fecha Cierre</th>
                </tr>
                </tfoot>
                </table>
                 </div>
            <!-- /.box-body -->
          </div>';
}//while de mecanico
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
</section>
<?php
include("footer.php");
?>