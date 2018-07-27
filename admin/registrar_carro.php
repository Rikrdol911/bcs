<?php include("menu.php");
?>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$(".telf").mask("(9999) 9999-999");
});
</script>
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
        <li class="active">Registrar Vehiculo</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
    <style>
	#ref{
		display:none;	
	}
	</style>
<script>
$(document).ready(function(){
$('.verificar').click(function() {
  // Enviamos el formulario usando AJAX
  var dni = $("#dn").val();
  var tip = $("#tip").val();
        $.ajax({
			async: true,   
            type: 'POST',
            url: 'verificar_registro.php',
            data: {dni:dni,tip:tip},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#mas').html(data);
				$('#ref').show();
            }
        })        
        return false;
  
    }); 	
}); 	

</script>
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id'])){
	$id_cliente=filtroxss($_GET['id']);
	$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1");
	$s=cons($consulta);
	if(mysqli_num_rows($s)<=0){
	unset($id_cliente);
	}else{
	while($ros=mysqli_fetch_array($s)){
	$nombre_cliente=$ros['nombre'];
	$tipo=$ros['id_tipo'];
	$dni=$ros['dni'];	
	}
	}
}
	echo '<div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Registrar Vehiculo</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div></div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_carro.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
			    <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="tipo" id="tip" required>';
if(isset($tipo)){
$consulta=("SELECT * FROM tipo WHERE id_tipo='$tipo'");	
}else{
$consulta=("SELECT * FROM tipo");
}
$d=cons($consulta);
while($row=mysqli_fetch_array($d)){
echo "<option value=".$row['id_tipo'].">".$row['nombre']."</option>";	
}
              echo '</select>
                </div>
                </div>
                
        <div class="col-lg-4 col-md-4 col-xs-10">
				<div class="form-group">
        <label for="Documento">Documento</label>';
				  if(isset($id_cliente)){  
					  echo '  
			  <div class="input-group">
                <input type="text" id="dn" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" maxlength="10" value="'.$dni.'" required>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat verificar">Verificar</button>
                    </span>
              </div>';  
		    }else{
       echo '  
			  <div class="input-group">
                <input type="text" id="dn" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" maxlength="10" required>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat verificar">Verificar</button>
                    </span>
              </div>'; 
				  }
          echo ' </div>
                </div>';
        if(isset($id_cliente)){
				echo '<div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
          <label for="Nombre">Nombre</label>
          <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" value="'.$nombre_cliente.'" name="nombre" required readonly>
				  <input type="hidden" name="id_cliente" value="'.$id_cliente.'" required>
           </div>
           </div>';	
				}
				echo '<!-- /. Documento Nacional de Identidad -->

                <!-- Nombre de Cliente -->
				<div id="mas">
        </div>
        
			  </div>
              <!-- /.box-body -->

              <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Registrar Vehiculo</button>
              </div>
              <!-- /.btn envio -->
             </div>
            </form>
            <!-- /.formulario cliente -->';
		  echo "<div id='clearfix'></div>";

  $consult=("SELECT * FROM marca");
		  $d=cons($consult);
		  $ti=array();
		  while($fg=mysqli_fetch_array($d)){
			  $ti[$fg['id_marca']]=$fg['nombre'];
		  }
		  $consulta=("SELECT * FROM tipo");
		  $da=cons($consulta);
		  $tia=array();
		  while($fga=mysqli_fetch_array($da)){
			  $tia[$fga['id_tipo']]=$fga['nombre'];
		  }
		  $consulta=("SELECT * FROM carro WHERE habilitado=0");
		  $s=cons($consulta);
		  if(mysqli_num_rows($s)<=0){
			echo alerta("No hay ningun carro registrado");  
		  }else{
			  echo '<div class="box box-danger">
              <div class="box-header with-border text-center">
              <h3 class="box-title">Veh&iacute;culos Registrados</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Due&ntilde;o</th>
				  <th>DNI</th>
                  <th>Placa</th>
				   <th>Marca</th>
                  <th>Modelo</th>
                  <th>A&ntilde;o</th>
				  <th>Color</th>
				  <th>Cilindradra</th>
				  <th>Caja de Vel.</th>
				  <th>Contacto</th>
				  <th>OR</th>
                </tr>
                </thead>
                <tbody id="prep">
               ';
			  while($row=mysqli_fetch_array($s)){
				  $id_dueno=$row['id_cliente'];
				  $co=("SELECT * FROM cliente WHERE id_cliente='$id_dueno' LIMIT 1");
				  $d=cons($co);
				  while($y=mysqli_fetch_array($d)){
					$nombre_dueno=$y['nombre'];  
					$id_ti=$y['id_tipo'];
					$dns=$y['dni'];
				  }
			  echo ' <tr>
               <td> <a href="perfil.php?id='.$id_dueno.'">'.$nombre_dueno.'</a></td>
				  <td>'.$tia[$id_ti].'-'.$dns.'</td>
				                    <td><a href="perfil_carro.php?placa='.$row['placa'].'">'.$row['placa'].'</a></td>
				  <td>'.$ti[$row['id_marca']].'</td>
				  <td>'.$row['modelo'].'</td>
				  <td>'.$row['ano'].'</td>
				  <td>'.$row['color'].'</td>
				  <td>'.$row['cilindro'].'</td>
				  <td>'.$row['caja'].'</td>';
				  $coa=explode("!#!",$row['contacto']);
				  $contact=$coa[0]."-".$coa[1];
				  echo '<td>'.$contact.'</td>
				  <td><a href="abrir_orden.php?id_carro='.$row['id_carro'].'">Abrir OR Nueva</a></td>
                </tr> ';
			  
			  }
			  echo ' </tbody>
                <tfoot>
                <tr>
				  <th>Due&ntilde;o</th>
				   <th>DNI</th>
                  <th>Placa</th>
				   <th>Marca</th>
                  <th>Modelo</th>
                  <th>A&ntilde;o</th>
				  <th>Color</th>
				  <th>Cilindrada</th>
				  <th>Caja de Vel.</th>
				  <th>Contacto</th>
                <th>OR</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>';
		  }
	



}
include("footer.php");
?>
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
