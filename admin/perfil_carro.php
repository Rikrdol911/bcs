<?php include("menu.php");?>
<!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
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
if(isset($_GET['placa'])){
$placa=filtroxss($_GET['placa']);
$consulta=("SELECT * FROM carro WHERE placa='$placa' AND habilitado=0 LIMIT 1");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
	echo alerta("Ha ocurrido un error en la consulta");	
	}else{

	while ($row=mysqli_fetch_array($f)) {
			$id_marca=$row['id_marca'];
			$id_carro=$row['id_carro'];
			$id_cliente=$row['id_cliente'];
			$vin=$row['vin'];
			$modelo=$row['modelo'];
			$serial_motor=$row['serial_motor'];
			$ano=$row['ano'];
			$placa=$row['placa'];
			$color=$row['color'];
			$cilindro=$row['cilindro'];
			$caja=$row['caja'];
			$valvula=$row['valvula'];
			$contacto=$row['contacto'];
			$scontacto=explode('!#!', $contacto);
			$nombre_contacto=$scontacto[0];
			$telefono_contacto=$scontacto[1];
		}
$consulta2=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1");
$f2=cons($consulta2);
if (mysqli_num_rows($f2)<=0) {
echo alerta("Error en consulta de cliente");
}else{

	while ($row2=mysqli_fetch_array($f2)) {
	$nombre=$row2['nombre'];
	$telf=$row2['telf'];
	$correo=$row2['correo'];
	$dni=$row2['dni'];
}
	}
$consulta3=("SELECT * FROM marca WHERE id_marca='$id_marca' LIMIT 1");
$f3=cons($consulta3);
if (mysqli_num_rows($f3)<=0) {
	echo alerta("Error en consulta de marca");
}else{
	while ($row3=mysqli_fetch_array($f3)) {
		$nombre_marca=$row3['nombre'];
		
	}
	}
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>&nbsp;'.$nombre_marca.'&nbsp; '.$modelo.' &nbsp;'.$ano.' &nbsp;'.$caja.' &nbsp;'.$cilindro.' &nbsp;'.$valvula.' &nbsp;'.$color.'</b></h3>
            </div>
            <!-- /.box-header -->
 			
 			<!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_actualizar_carro.php">
              <div class="box-body">

			<!-- Titular -->
          <div class="col-lg-12 col-md-12 col-xs-10">
			    <div class="form-group">
                  <label for="Titular">Titular del Veh&iacute;culo</label>
                  <select class="form-control select2" name="nid_cliente" required style="width: 100%;"><option selected="selected">Alabama</option>';
                  
$consultaa=("SELECT * FROM cliente WHERE habilitado=0");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
	$nombre2=$rowa['nombre'];
	if($nombre2==$nombre){
		echo "<option selected value=".$rowa['id_cliente'].">".$rowa['nombre']."</option>";	
	}else{
echo "<option value=".$rowa['id_cliente'].">".$rowa['nombre']."</option>";	
	}
}
              echo '</select>
                </div>
                </div>
                <!-- /.Titular -->

           <!-- Marca -->
          <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Marca">Marca de Veh&iacute;culo</label>
                  <select class="form-control" name="nid_marca">';

$consultaa=("SELECT * FROM marca");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
	$nombre_marca2=$rowa['nombre'];
	if($nombre_marca2==$nombre_marca){
		echo "<option selected value=".$rowa['id_marca'].">".$rowa['nombre']."</option>";	
	}else{
echo "<option value=".$rowa['id_marca'].">".$rowa['nombre']."</option>";	
	}
}
              echo '</select>
                </div>
                </div>
                <!-- /.Marca -->

                <!-- VIN -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="VIN">VIN</label>
                  <input type="text" class="form-control" placeholder="VIN de Veh&iacute;culo" name="nvin" value="'.$vin.'" required>
                </div>
                </div>
                <!-- /.VIN -->

                <!-- Modelo -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Modelo">Modelo</label>
                  <input type="text" class="form-control" placeholder="Modelo de Veh&iacute;culo" name="nmodelo" value="'.$modelo.'" required>
                </div>
                </div>
                <!-- /.Modelo -->

                <!-- Serial de Motor -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Serial de Motor">Serial de Motor*</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" name="nserial_motor" value="'.$serial_motor.'">
                </div>
                </div>
                <!-- /.Serial de Motor -->


           		<!-- Ano Carro -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Ano">A&ntilde;o</label>
                  <input type="text" class="form-control" placeholder="Ingresa el A&ntilde;o" name="nano" maxlength="4" value="'.$ano.'">
                </div>
                </div>
                <!-- /.Serial de Motor -->	

                <!-- Placa -->
          		<div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Placa">Placa</label>
                  <input type="hidden" value="'.$placa.'" name="placa">
                  <input type="text" class="form-control" name="nplaca" value="'.$placa.'" maxlength="30" required>
                  </div>
          </div>
          <!-- /.Placa -->	

           <!-- color -->
          <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Color">Color</label>
                  <input type="text" class="form-control" name="ncolor" value="'.$color.'" maxlength="30" required>
                  </div>
          </div>
          <!-- /.color -->

           <!-- Cilindro -->
          <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Cilindro">Cilindro</label>
                  <input type="text" class="form-control" name="ncilindro" value="'.$cilindro.'" maxlength="30" required>
                  </div>
          </div>
          <!-- /.Cilindro -->

 		  <!-- caja -->
          <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Caja</label>
                  <select class="form-control" name="ncaja" required>
                  <option selected="selected">'.$caja.'</option>
				  <option>Automatica</option>
				  <option>Manual</option>
				  <option>Dual</option>
				  </select>
                </div>
                </div> 
          <!-- /.caja -->

          <!-- Valvula -->
		<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Valvula</label>
                  <input type="text" value="'.$valvula.'" class="form-control" placeholder="Ingresa la valvula del vehiculo" maxlength="4" name="nvalvula" required>
                </div>
                </div>
           <!-- /.valvula -->

           <!-- contacto -->
         <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Nombre del contacto</label>
                  <input type="text" value="'.$nombre_contacto.'" class="form-control" placeholder="Ingresa el nombre del contacto" name="nnombre_contacto" required>
                </div>
                </div>
          <!-- /.contacto -->

           <!-- Telefono -->
			<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Telefono">Telefono De Contacto</label>
                  <input type="text" value="'.$telefono_contacto.'" class="form-control" placeholder="Ingresa el Numero del contacto" name="ntelefono_contacto" required>
                </div>
                </div>
           <!-- /.contacto -->

           <!-- campos opcionales -->
           <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                <div class="checkbox">
                  <label>
                    Campos con (*) son opcionales
                  </label>
                </div>
              </div>
              <!-- /.campos opcionales -->
               <!-- /.box-body -->

          <div class="box-footer text-center">
          <div class="col-lg-6 col-md-6 col-xs-6 text-center">
                <button type="submit" id="ref" class="btn btn-primary">Actualizar Informaci&oacute;n</button>
              
            </form>
            </div>

             <div class="col-lg-6 col-md-6 col-xs-6 text-center">
            <form id="formulario2" role="form" method="POST" enctype="multipart/form-data" action="pro_eliminar_carro.php">
            <input type="hidden" name="placa" value="'.$placa.'">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar Veh&iacute;culo</button>
             <!-- Modal -->
<div id="myModal" class="modal fade col-lg-offset-1 col-md-offset-1 col-xs-offset-0" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Desea Realizar la Operaci&oacute;n?</h3>
      </div>
      <div class="modal-body">
        <p>Eliminar Veh&iacute;culo?</p><h5>'.$placa.'&nbsp;'.$marca.'&nbsp;'.$modelo.'&nbsp;'.$ano.'&nbsp;'.$cilindro.'&nbsp;'.$valvula.'&nbsp;'.$caja.'&nbsp;'.$color.'&nbsp; de Cliente:&nbsp;'.$nombre.'.</h5>
        <p>Introdusca la placa para confirmar:</p>
        
       
        <input type="text" name="placaconf" class="form-control" placeholder="Placa del Veh&iacute;culo" maxlength="30" required>
     

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar Veh&iacute;culo</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
            </form>
            </div>
            </div>
          </div>
         </div>
         ';
		  echo "<div id='clearfix'></div>";	
$consulta=("SELECT * FROM o_r WHERE id_carro='$id_carro'");
$d=cons($consulta);
if(mysqli_num_rows($d)<=0){

echo negativo("No has realizado ninguna Orden de Reparacion de este Veh&iacute;culo");
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
                  <th>KM</th>                 
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
$km=$e['kilometros'];
$titulo=unserialize($e['array_titulo']);
echo '<td><a href="detalles_or.php?id_or='.$id_or.'">'.$numero_or.'</a></td>
      <td>'.number_format($km,0,',','.').' KM</td>';
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
                  <th>KM</th>            
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

?>
    </section>
<!-- /.Main content -->

<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(document).ready(function(){
        $("#formulario").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario"));
            formData.append("dato", "valor");
			$("#ref").hide();
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
				dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	            processData: false
            })
                .done(function(res){
					
					$("#ref").show();
                    $("#respuesta").html(res);
                });
        });
    });
</script>
<script>
  $(document).ready(function(){
        $("#formulario2").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario2"));
            formData.append("dato", "valor");
			$("#ref2").hide();
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
				dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	            processData: false
            })
                .done(function(res){
					
					$("#ref").show();
                    $("#respuesta").html(res);
                });
        });
    });
</script>
<script>
$(function () {
    //Initialize Select2 Elements
$(".select2").select2();
});
</script>
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
}
}}
include('footer.php');
?>