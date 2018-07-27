<?php $conectar=TRUE; include("conexion.php"); 
?>
  <script>
$(document).ready(function(){
$('.formularios').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
			async: true,   
            type: 'POST',
            url: 'pro_agregar_mano_obra.php',
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#agregado').prepend(data);
				
            }
        })        
        return false;
  
    }); 		
 });
</script>

<?php
if(isset($_SESSION['ingreso'])){
if(isset($_POST['id'])){
$id_mano=filtroxss($_POST['id']);
$consulta=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)>=1){
	while($fb=mysqli_fetch_array($d)){
$hora=$fb['horas'];
$precio=$fb['precio'];

	}
	$id_or=filtroxss($_POST['id_or']);
$cons=("SELECT * FROM descripcion_mano_de_obra WHERE id_mano='$id_mano'");
$vc=cons($cons);
echo '<br><div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Selecciona</h3>
                  <div class="box-tools pull-right">
                   
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="formularios" action="pro_agregar_mano_obra.php" method="POST">

              <div class="box-body">   
              <div class="col-lg-3 col-md-3 col-xs-10">
                <div class="form-group">
                <label>Servicio de garant&iacute;a&nbsp;&nbsp;
                 <input type="checkbox" name="garantia" value="1"></label>
                </div>  
                 </div>
              <div class="col-lg-2 col-md-2 col-xs-10">
               <label> Horas</label>
                <div class="form-group">
                 
                  <input type="number" class="form-control" id="exampleInputEmail1" name="horas" value="'.$hora.'">
                </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-xs-10">
                  <label for="exampleInputPassword1">Precio</label>
                <div class="form-group">
                  
                  <input type="text" class="form-control" id="exampleInputPassword1" name="precio" value="'.$precio.'">
                  <input type="hidden" class="form-control" id="exampleInputPassword1" name="id_mano" value="'.$id_mano.'">
                  <input type="hidden" class="form-control" id="exampleInputPassword1" name="id_or" value="'.$id_or.'">
                </div>
                </div>

                 <div class="col-lg-10 col-md-10 col-xs-10">
                <div class="checkbox"><b>Selecciona Las Tareas Realizadas</b><br>';
                while($row=mysqli_fetch_array($vc)){
                  echo '<label>
                    <input type="checkbox" name="id_descripcion[]" value="'.$row['id_descripcion'].'"> '.$row['nombre'].'
                  </label><br>';
}
                  

                echo '</div><hr>
              </div>
              <!-- /.box-body -->

              <div class="col-md-12 col-lg-12 col-xs-10 text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </form>
          </div>';





}
}
}
?>