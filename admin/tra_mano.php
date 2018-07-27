<?php include("menu.php");
?>
<script>
$(document).ready(function(){
$(".eliminar2").on("click", function() {
  var id_mano = $(this).attr("id");
  $.ajax({
      async: true,   
            type: 'POST',
            url: 'eliminar_mano.php',
            data: {id_mano:id_mano},
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
    <style>
  #ref{
    display:none; 
  }
  </style>
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
        <li class="active">Registrar Trabajos de Mano de Obra</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){


echo '<div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Registrar Mano de Obra</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
<!-- form start -->

<form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="pro_registrar_mano.php">
              <div class="box-body">
                  <!-- Descripcion -->
                <div class="col-lg-6 col-md-6 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Descripci&oacute;n</label>
                  <input type="text" class="form-control" placeholder="Descripci&oacute;n" name="nombre" maxlength="140" required>
                </div>
                </div>
                <!-- /. Descripcion -->
                  <!-- Horas -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Horas</label>
                  <input type="number" class="form-control" placeholder="Horas" name="horas" min="1" required>
                </div>
                </div>
                <!-- /. Horas -->
                   <!-- Horas -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Precio</label>
                  <input type="number" class="form-control" placeholder="Precio" name="precio" min="1" required>
                </div>
                </div>
                <!-- /. Horas -->
                  <!-- Horas -->
                <div class="col-lg-4 col-md-4 col-xs-10">
					<div class="form-group">
                  <label for="Nombre">Trabajos</label>
                <input type="text" id="trabajos_1" class="form-control" placeholder="Trabajo" name="trabajos[]" maxlength="140" required>
                </div>
                </div>          
                  <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                  <button id="agregar" class="btn btn-info">+ Trabajos</button></div>
                <div id="agregado"></div>
                <!-- /. Horas -->
              </div>
 			<!-- /.box-body -->

              <!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Registrar Trabajo</button>
              </div>
              <!-- /.btn envio -->
              </form>  <!-- /.formulario cliente -->
          </div>';
          		  echo "<div id='clearfix'></div>
                <div id='ref'></div>";
echo '<div class="box box-danger">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Manos de Obra</h3>
              </div>
            <!-- /.box-header -->

            <div class="box-body"> <h3>*No elimines si hay OR con ella</h3><div id="mas">
        </div><div id="ref"></div>';
if(isset($_GET['id_man'])){
  $id_man=filtroxss($_GET['id_man']);
$consulta=("SELECT * FROM mano_de_obra WHERE id_mano=' $id_man' AND habilitado=0");
}else{
  $consulta=("SELECT * FROM mano_de_obra WHERE habilitado=0");
}

$f=cons($consulta);
  echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripci&oacute;n</th>
                   <th>Horas</th>
                  <th>Precio</th>
                  <th>Eliminar</th>
                  <th>Editar</th>               
                </tr>
                </thead>
                <tbody id="prep">';
while($row=mysqli_fetch_array($f)){
  $id_mano=$row['id_mano'];
  $nombre_mano=$row['nombre'];
  $horas=$row['horas'];
  $precios=$row['precio'];

echo '<tr id="a'.$id_mano.'">';
echo '<td>'.$id_mano.'</td>';
if(isset($_GET['id_man'])){
echo '<td><form class="formulario" method="POST" action="pro_actualizar_mano.php">';
echo '<input type="text" class="form-control" name="nombre_mano" value="'.$nombre_mano.'" maxlength="140" required><input type="hidden" name="id_mano" value="'.$id_mano.'" required><br>';
$cond=("SELECT * FROM descripcion_mano_de_obra WHERE id_mano='$id_mano'");
  $a=cons($cond);
  echo "Descripciones *(<small>Para eliminar, deja el campo en blanco</small>)<br>";
  while($fds=mysqli_fetch_array($a)){
    echo "<input type='text' class='form-control' name='nombres[]' value='".$fds['nombre']."'><input type='hidden' name='id_detalle[]' value=".$fds['id_descripcion']."><br><br>";
  }
  echo '<button id="agregar2" class="btn btn-info">+ Trabajos</button></div>
                <div id="agregado2"></div>';
echo '</td>';
echo '<td><input type="number" class="form-control" name="horas" value="'.$horas.'" required></td>';
echo '<td><input type="text" class="form-control" name="precio" value='.$precios.' required>Bs</td>';
echo "<td><button class='btn btn-danger btn-sm eliminar2' id='".$id_mano."'>&times;</button></td>";
echo "<td><button type='submit' class='btn btn-primary'>Guardar</button></td>";
echo '</tr></form>';

}else{
echo '<td>';
echo $nombre_mano.'<br>';
$cond=("SELECT * FROM descripcion_mano_de_obra WHERE id_mano='$id_mano'");
  $a=cons($cond);
  while($fds=mysqli_fetch_array($a)){
    echo "&nbsp;&nbsp;&nbsp;-<b>".$fds['nombre']."</b><br>";
  }

echo '</td>';
echo '<td>'.$horas.'</td>';
echo '<td>'.number_format($precios,2,",",".").'&nbsp;Bs</td>';
echo "<td><button class='btn btn-danger btn-sm eliminar2' id='".$id_mano."'>&times;</button></td>";
echo "<td><a href='tra_mano.php?id_man=".$id_mano."' class='btn btn-info btn-sm' id='".$id_mano."'><i class='glyphicon glyphicon-pencil'></i></a></td>";
echo '</tr>';

}
}
 echo ' </tbody>
  </table>';
                
?>
<script>
var array = [];
 array.push('1');
function numeroAleatorio(limite){
  return Math.floor(Math.random()*limite);
}
	$(document).ready(function() {

    var MaxInputs = 20; //Número Maximo de Campos
    <?php if(isset($_GET['id_man'])){ ?>

    var contenedor = $("#agregado2"); //ID del contenedor
    var AddButton = $("#agregar2"); //ID del Botón Agregar
<?php 
}else
{
  ?>
    var contenedor = $("#agregado"); //ID del contenedor
    var AddButton = $("#agregar"); //ID del Botón Agregar
 <?php 
}
?>
    //var x = número de campos existentes en el contenedor
    var x = $("#agregardo div").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
        	var aleatorio =(numeroAleatorio(100000));
  			array.push(aleatorio);
            FieldCount++;
            //agregar campo
            $(contenedor).append('<div><div class="col-lg-4 col-md-4 col-xs-10"><div class="form-group"><a href="#" class="eliminar">&times;</a><input type="text" id="trabajos_'+ FieldCount +'" class="form-control" placeholder="Trabajo" name="trabajos[]" maxlength="140" required></div></div></div>');
            x++; //text box increment
        }
        return false;
    });
    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
});
</script>
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
</section>
</div>
    <?php
}
include("footer.php");
?>
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