<?php include("menu.php");
?>
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<script>
$(document).ready(function(){
$('.veri').click(function() {
   var id = $( "select option:selected" ).val();
   var id_or = <?php echo $_GET['id_or']; ?>;
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'verificar_mano.php',
            data: {id:id,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#mas').html(data);
        
            }
        })        
        return false;
  
    });
$('.pieza').click(function() {
   var id = $( "#codigo_pieza" ).val();
   var id_or = <?php echo $_GET['id_or']; ?>;
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'verificar_la_pieza.php',
            data: {id:id,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#verf').html(data);
        
            }
        })        
        return false;
  
    });
$('.atc_mano').click(function() { 
  var id_mano = $(this).attr("id");
   var precio_mano = $( "#pre-"+id_mano+"" ).val();
   var id_or= <?php echo $_GET['id_or']; ?>;  
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'pro_actualizar_precio_mano.php',
            data: {id_mano:id_mano,precio_mano:precio_mano,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('body').append(data);
        
            }
        })        
        return false;
  
    });
$('.atc_pie').click(function() { 
  var id_pieza = $(this).attr("id");
   var precio_pieza = $( "#pie-"+id_pieza+"" ).val();
   var id_or= <?php echo $_GET['id_or']; ?>;  
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'pro_actualizar_precio_pieza.php',
            data: {id_pieza:id_pieza,precio_pieza:precio_pieza,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('body').append(data);
        
            }
        })        
        return false;
  
    });
$("#example5").on("click", ".eliminar_abono", function(){
  var id_abono_or = $(this).attr("id");
  var id_or= <?php echo $_GET['id_or']; ?>; 
  var n_vaucher = $( "#n-"+id_abono_or+"" ).val();
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'pro_eliminar_abono.php',
            data: {id_abono_or:id_abono_or,id_or:id_or, n_vaucher:n_vaucher},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('body').append(data);
        
            }
        })        
        return false;
  
    });
$("#example5").on("click", ".atc_abono", function(){
  var id_abono_or = $(this).attr("id");
  var n_vaucher = $( "#n-"+id_abono_or+"" ).val();
  var monto = $( "#abono-"+id_abono_or+"" ).val();
  var id_tipo_pago = $( "#tipo-"+id_abono_or+"" ).val();
   var id_or= <?php echo $_GET['id_or']; ?>; 
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'pro_actualizar_abono.php',
            data: {id_abono_or:id_abono_or,monto:monto,id_or:id_or,n_vaucher:n_vaucher,id_tipo_pago:id_tipo_pago},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('body').append(data);
        
            }
        })        
        return false;
  
    });
    $("#example1").on("click", ".eliminar", function(){
  var id_mano = $(this).attr("id");
  var id_or = <?php echo $_GET['id_or'];?>;
  $.ajax({
      async: true,   
            type: 'POST',
            url: 'eliminar_procesar.php',
            data: {id_mano:id_mano,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('body').append(data);
        
            }
        })        
        return false;
});    
$("#example3").on("click", ".eliminar_repuesto", function(){
  var id_pieza = $(this).attr("id");
  var id_or = <?php echo $_GET['id_or'];?>;
  $.ajax({
      async: true,   
            type: 'POST',
            url: 'eliminar_procesar_repuesto.php',
            data: {id_pieza:id_pieza,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
             
                $('body').append(data);
        
            }
        })        
        return false;
});    
$("#example4").on("click", ".eliminar_servicio", function(){
  var codigo = $(this).attr("id");
  var id_or = <?php echo $_GET['id_or'];?>;
  $.ajax({
      async: true,   
            type: 'POST',
            url: 'eliminar_procesar_servicio.php',
            data: {codigo:codigo,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
           
                $('body').append(data);
        
            }
        })        
        return false;
}); 

$(".cerrar").on("click", function() {
  var id_or = <?php echo $_GET['id_or'];?>;
  $.ajax({
      async: true,   
            type: 'POST',
            url: 'cerrar_or.php',
            data: {id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
           
                $('#que').html(data);
        
            }
        })        
        return false;
});    

$('.veri').click(function() {
   var id = $( "select option:selected" ).val();
   var id_or = <?php echo $_GET['id_or']; ?>;
  // Enviamos el formulario usando AJAX
        $.ajax({
      async: true,   
            type: 'POST',
            url: 'verificar_mano.php',
            data: {id:id,id_or:id_or},
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#mas').html(data);
        
            }
        })        
        return false;
  
    });

    }); 
</script>
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
        <li><a href="ordenes_or.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Orden de Reparacion</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
    <?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['id_or'])){
if(is_numeric($_GET['id_or'])){
$id_or=filtroxss($_GET['id_or']);

  $consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 LIMIT 1");
  $v=cons($consulta);
  if(mysqli_num_rows($v)<=0){
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=detalles_or_a.php?id_or='.$id_or.'">';
exit;
  }
  while($rf=mysqli_fetch_array($v)){
    $id_cliente=$rf['id_cliente'];
    $imp=$rf['imp'];
    $numero_or=$rf['numero_or'];
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Orden De Reparacion <b>['.$rf['numero_or'].']</b>&nbsp;</h3><hr>';
$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1"); 
$ds=cons($consulta);
while($g=mysqli_fetch_array($ds)){
  echo "<b>Cliente: </b><a href='perfil.php?id=".$g['id_cliente']."'>".$g['nombre']."</a>";
  $nombre_cliente=$g['nombre'];
}
$id_carro=$rf['id_carro'];
$con=("SELECT * FROM carro WHERE id_carro='$id_carro' AND habilitado=0 LIMIT 1");
$d=cons($con);
if(mysqli_num_rows($d)<=0){
echo negativo("No existe el carro");
  exit;
}
while($f=mysqli_fetch_array($d)){
  echo "<br><b>Vehiculo: </b><a href='perfil_carro.php?placa=".$f['placa']."'>".$f['modelo']." - ".$f['placa']."</a>";
}
$fecha_apertura1=$rf['fecha_apertura'];
$explode1=explode('-', $fecha_apertura1);
$fecha_apertura12=$explode1[2]."/".$explode1[1]."/".$explode1[0];
echo "<br><b>Kilometraje: </b>".number_format($rf['kilometros'],0,',','.')." KM";
echo "<br><b>IVA: </b>".$rf['iva']." %"; $iva=$rf['iva'];
$id_mecanico=$rf['id_mecanico'];
$consulta2=("SELECT * FROM mecanico WHERE id_mecanico='$id_mecanico' AND habilitado=0 LIMIT 1");
      $s2=cons($consulta2);
      if(mysqli_num_rows($s2)<=0){
      echo alerta("No hay ningun Mec&aacute;nico registrado");  
      }else{
while($f2=mysqli_fetch_array($s2)){
$nombre_mecanico=$f2['nombre'];
echo "<br><b>Mecanico Asignado:</b>&nbsp;".$nombre_mecanico."";
}
}
echo "<br><b>Fecha de Apertura:</b> ".$fecha_apertura12."";
$fecha_cierre=$rf['fecha_cierre'];
if($fecha_cierre=="0000-00-00"){
echo '<br><b>Estatus: </b><span class="badge bg-aqua">Abierta</span><br>';
echo '<a href="edit_or.php?id_or='.$id_or.'"><i class="fa fa-edit"></i>Editar</a>';
}else{
$explode2=explode('-', $fecha_cierre);
$fecha_cierre22=$explode2[2]."/".$explode2[1]."/".$explode2[0];
  echo '<br><b>Fecha de Cierre: </b>'.$fecha_cierre22.'<h2> <span class="badge bg-danger">Cerrada</span></h2>';
}
           echo '</div></div>';
}
echo '<div class="col-md">
          <div class="box box-warning box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Mano De Obra</h3>

              <div class="box-tools pull-right ">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <div class="box-body"> ';
              echo '<div id="agregado"></div>';
            if($fecha_cierre=="0000-00-00"){
            echo '<p class="margin">Seleccionar Mano de Obra</p>
<div class="input-group">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-info veri">Verificar</button>
                </div>
                <!-- /btn-group -->
               <select class="form-control select2" id="sel" style="width: 100%;">
                 ';
                $consulta=("SELECT * FROM mano_de_obra WHERE habilitado=0");
                $rf=cons($consulta);
                while($row=mysqli_fetch_array($rf)){
echo '<option value="'.$row['id_mano'].'">'.$row['nombre'].'</option>';
                }
                echo '</select>
              </div>';
            }
      echo '<div id="mas"></div><br>';
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$f=cons($consulta);
while($row=mysqli_fetch_array($f)){
  $titulo=unserialize($row['array_titulo']);
  $mano_obra=unserialize($row['array_mano_obra']);
  $horas=unserialize($row['array_horas']);
  $precios=unserialize($row['array_precio']);
  $garantia=unserialize($row['array_garantia']);
  echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripcion</th>
                  <th>Horas</th>
                  <th>Precio</th>
                  <th>Garant.</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody id="prep">';
  //aqui iban muchos td... pero los elimine
foreach($titulo as $numero => $id_mano){
$consd=("SELECT * FROM mano_de_obra WHERE id_mano='$id_mano' LIMIT 1");
$df=cons($consd);
while($fg=mysqli_fetch_array($df)){
  $nombre_mano=$fg['nombre'];
}
echo '<tr id="a'.$id_mano.'">';
echo '<td>'.$id_mano.'</td>';
echo '<td>';
echo $nombre_mano.'<br>';
$la_mano=$mano_obra[$numero];
if(count($la_mano)!=0){
foreach($la_mano as $nume =>$id_descripcion){
  $cond=("SELECT * FROM descripcion_mano_de_obra WHERE id_descripcion='$id_descripcion' LIMIT 1");
  $a=cons($cond);
  while($fds=mysqli_fetch_array($a)){
    echo "&nbsp;&nbsp;&nbsp;-<b>".$fds['nombre']."</b><br>";
  }
}
}
echo '</td>';
echo '<td>'.$horas[$numero].'</td>';
echo '<td><input type="text" class="form-control" id="pre-'.$id_mano.'" value='.number_format($precios[$numero],2,",",".").'> Bs&nbsp; <button class="btn btn-info glyphicon glyphicon-floppy-saved atc_mano" id="'.$id_mano.'"></button></td>';
$garant=$garantia[$numero];
if($garant==0){
  echo "<td>No</td>";
}else{
 echo '<td>Si</td>'; 
}if($fecha_cierre=="0000-00-00"){
echo "<td><button class='btn btn-danger glyphicon glyphicon-remove eliminar' id='".$id_mano."'></button></td>";
}else{
  echo "<td></td>";
}
echo '</tr>';


}

                 echo ' </tbody>
              </table>';
}


    
            echo '</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>';

echo '<div class="col-md">
          <div class="box box-warning box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Repuestos</h3>

              <div class="box-tools pull-right ">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div><div class="box-body">
            <!-- /.box-header -->
';
if($fecha_cierre=="0000-00-00"){
            echo '<label>Codigo De Pieza</label> ';
echo '<div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-info pieza">Verificar</button>
                </div>
                <!-- /btn-group -->
                <select type="text" class="form-control select2" style="width: 100%;" id="codigo_pieza" placeholder="Ingrese Codigo de Pieza" required>';
$consulta=("SELECT * FROM pieza WHERE (habilitado=0 OR habilitado=3);");
$pr=cons($consulta);
while($t=mysqli_fetch_array($pr)){
$id_pieza=$t['id_pieza'];
$habilitado_pieza=$t['habilitado'];
$lac=cantidad($id_pieza);
if($habilitado_pieza==3 && $lac<=0){

}else{
  echo "<option value=".$t['codigo_pieza'].">".$t['nombre']." ".$t['codigo_pieza']."&nbsp;(".$lac.")</option>";
}

}      
echo '</select></div>';
}
              echo '<div id="verf"></div>';
echo '<br><br><table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio Bs</th>
                  <th>Total</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody id="prep">';

$consu=("SELECT * FROM repuesto_or WHERE id_or='$id_or' AND (habilitado=0 OR habilitado=3)");
$co=cons($consu);
while($ro=mysqli_fetch_array($co)){
$id_pie=$ro['id_pieza'];
$cant=$ro['cantidad'];
$prec=$ro['precio'];
$taller=$ro['taller'];
$cod=("SELECT * FROM pieza WHERE id_pieza='$id_pie' LIMIT 1");
$s=cons($cod);
while($f=mysqli_fetch_array($s)){
echo '<tr id="b'.$id_pie.'"><td>'.$f['codigo_pieza'].'</td><td>'.$f['nombre'].'</td><td>'.$cant.'</td></td>';
if($taller==0){
echo '<td><input type="text" class="form-control" id="pie-'.$id_pie.'" value='.number_format($prec,2,",",".").'> Bs&nbsp;<button class="btn btn-info glyphicon glyphicon-floppy-saved atc_pie" id="'.$id_pie.'"></button><td>'.number_format(($cant*$prec),2,",",".").' Bs</td>';
}else{
echo '<td>Traido Por Cliente</td><td>Traido Por Cliente</td>';
}if($fecha_cierre=="0000-00-00"){
echo '<td><button class="btn btn-danger glyphicon glyphicon-remove eliminar_repuesto" id="'.$id_pie.'"></button></td>';
}else{
echo '<td></td>';
}
}
}
 echo ' </tbody>
              </table>';
echo '<div id="agregado2"></div>';

  echo '</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>';

echo '<div class="col-md">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Servicios</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
             ';
if($fecha_cierre=="0000-00-00"){
            echo '<form role="form" class="formulario" action="pro_servicio.php" method="POST">
            <div class="col-lg-6 col-md-6 col-xs-10">
          <div class="form-group">
                  <label for="Nombre">N° Factura Servicio</label>
                  <input type="text" class="form-control" placeholder="Ingresa N° factura del Servicio" name="codigo" required>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-10">
          <div class="form-group">
                  <label for="nombre_servicio">Proveedor del Servicio</label>
                  <input type="text" class="form-control" placeholder="Ingresa el proveedor del Servicio" name="nombre_servicio" required>
                </div>
                </div>
               <div class="col-lg-6 col-md-6 col-xs-10">
          <div class="form-group">
                  <label for="Monto">Monto</label>
                  <input type="text" class="form-control" placeholder="Ingresa el monto" name="monto" required>
                  <input type="hidden" class="form-control" name="id_or" value="'.$id_or.'" required>
                </div>
                </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
          <div class="form-group">
                  <label for="Monto">Costo del Servicio</label>
                  <input type="text" class="form-control" placeholder="Ingresa el costo" name="costo_servicio" required>
                  </div>
                </div>
                 <div class="col-lg-10 col-md-10 col-xs-10">
                <div class="form-group">
                  <label for="Descripcion">Descripcion</label>
                  <textarea class="form-control" placeholder="Ingresa la descripcion" name="descripcion" required></textarea>
                </div>
                </div>

                <div id="clearfix"></div>
                <div class="col-lg-11 col-md-11 col-xs-10 text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div></form>';
            }
            echo '<br><br><table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N° Factura</th>
                  <th>Pro. Servicio</th>
                  <th>Descripci&oacute;n</th>
                  <th>Monto</th>
                  <th>Costo del Servicio</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody id="prep4">';
$consulta=("SELECT * FROM servicios_or WHERE id_or='$id_or' AND habilitado=0;");
$r=cons($consulta);
while($ros=mysqli_fetch_array($r)){
echo '<tr id="w'.$ros['codigo'].'"><td>'.$ros['codigo'].'</td><td>'.$ros['nombre_servicio'].'</td><td>'.$ros['descripcion'].'</td><td>'.number_format($ros['monto'],2,",",".").'</td><td>'.number_format($ros['costo_servicio'],2,",",".").'</td>';
if($fecha_cierre=="0000-00-00"){
echo '<td><button class="btn btn-danger glyphicon glyphicon-remove eliminar_servicio" id='.$ros['codigo'].'></button></td>';
}else{
  echo '<td></td>';
}
echo '</tr>';
}
                 echo ' </tbody>
              </table>';
echo '<div id="agregado2"></div>';
             echo '
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>';

        echo '<div class="col-md">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Notas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">';
            $consult=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
            $d=cons($consult);
            $notas="";
            while($rq=mysqli_fetch_array($d)){
              $notas=$rq['notas'];
            }
             echo '
            
            <!-- form start -->
            <form role="form" action="pro_notas.php" method="POST" class="formulario">
              <div class="box-body">
                <div class="form-group">
                  <textarea class="form-control" id="exampleInputEmail1" name="notas" placeholder="Ingresa las notas del OR">'.$notas.'</textarea>
                  <input type="hidden" name="id_or" value="'.$id_or.'" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="col-lg-12 col-md-12 col-xs-10 text-center">';
              if($fecha_cierre=="0000-00-00"){
               echo  '<button type="submit" class="btn btn-primary">Actualizar</button>';
             }
              echo '</div>
            </form>
          </div>';

           echo '</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      ';

echo '<div class="col-md">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Pagos y Abonos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
             ';
if($fecha_cierre=="0000-00-00"){
            echo '<form role="form" class="formulario" action="pro_agregar_pago.php" method="POST">
                <div class="col-lg-6 col-md-6 col-xs-10">
          <div class="form-group">
                  <label for="fecha_pago">Fecha</label>
                  <input type="text" class="form-control pull-right" id="datepicker" name="fecha_pago" required>
                </div>
                </div>
            <div class="col-lg-6 col-md-6 col-xs-10">
          <div class="form-group">
           <label for="nombre_servicio">Tipo de Pago</label>
                 <select class="form-control" id="id_tipo_pago" name="id_tipo_pago" style="width: 100%;">
                 ';
                $consulta=("SELECT * FROM tipo_pago WHERE habilitado=0");
                $rf=cons($consulta);
                while($row=mysqli_fetch_array($rf)){
echo '<option value="'.$row['id_tipo_pago'].'">'.$row['nombre'].'</option>';
                }
              echo '</select>
               
                </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="nombre_servicio">N° Pago/Vaucher</label>
                  <input type="text" class="form-control" placeholder="Ingresa el No. de Pago" name="n_vaucher" required>
                </div>
                </div>
               <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Monto">Monto</label>
                  <input type="text" class="form-control" placeholder="Ingresa el monto" name="monto" required>
                  <input type="hidden" class="form-control" name="id_or" value="'.$id_or.'" required>
                </div>
                </div>
                    <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Persona">Persona</label>
                  <input type="text" class="form-control" placeholder="Ingresa la persona que abono" name="persona" value="'.$nombre_cliente.'" required>
                  </div>
                </div>
                <div id="clearfix"></div>
                <div class="col-lg-11 col-md-11 col-xs-10 text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div></form>';
            }
            echo '<br><br><table id="example5" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Tipo Pago</th>
                  <th>N° Pago/Vaucher</th>
                  <th>Monto</th>
                  <th>Persona</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody id="prep4">';
$consulta=("SELECT * FROM abono_or WHERE id_or='$id_or' AND habilitado=0;");
$r=cons($consulta);
while($ros2=mysqli_fetch_array($r)){
$id_abono_or=$ros2['id_abono_or'];
echo '<tr id="x'.$ros2['id_abono_or'].'"><td><input type="text" class="form-control pull-right" name="fecha_pago" value="'.$ros2['fecha'].'"></td><td>';
$id_tipo_pago=$ros2['id_tipo_pago'];
if($fecha_cierre=="0000-00-00"){
echo '<select class="form-control" id="tipo-'.$id_abono_or.'" style="width: 100%;">';
$consulta3=("SELECT * FROM tipo_pago WHERE habilitado=0");
$rf3=cons($consulta3);
while($row3=mysqli_fetch_array($rf3)){
if ($row3['id_tipo_pago']==$id_tipo_pago) {
 echo '<option value="'.$row3['id_tipo_pago'].'" selected>'.$row3['nombre'].'</option>';
}
echo '<option value="'.$row3['id_tipo_pago'].'">'.$row3['nombre'].'</option>';
}
}else{
echo '<select class="form-control" id="tipo-'.$id_abono_or.'" style="width: 100%;" disabled>'; 
$consulta3=("SELECT * FROM tipo_pago WHERE id_tipo_pago='$id_tipo_pago' AND habilitado=0");
$rf3=cons($consulta3);
while($row3=mysqli_fetch_array($rf3)){
echo '<option value="'.$row3['id_tipo_pago'].'" selected>'.$row3['nombre'].'</option>';
                } 
}
echo '</select></td><td><input type="text" class="form-control" id="n-'.$id_abono_or.'" value='.$ros2['n_vaucher'].'></td><td><input type="text" class="form-control" id="abono-'.$id_abono_or.'" value='.number_format($ros2['monto'],2,",",".").'>Bs&nbsp;</td><td>'.strtoupper($ros2['persona']).'</td>';
if($fecha_cierre=="0000-00-00"){
echo '
<td><button class="btn btn-info glyphicon glyphicon-floppy-saved atc_abono" id="'.$id_abono_or.'"></button></td>
<td><button class="btn btn-danger glyphicon glyphicon-remove eliminar_abono" id='.$ros2['id_abono_or'].'></button></td>

';
}else{
  echo '<td></td><td></td>';
}
echo '</tr>';
}
                 echo ' </tbody>
              </table>';
echo '<div id="agregado2"></div>';
             echo '
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>';








        echo '<div class="col-md">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">Procesar</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">';
             if($fecha_cierre=="0000-00-00"){
             echo  '<button type="button" class="btn btn-primary cerrar" id="'.$id_or.'">Cerrar OR</button><br><form name="formpdf" method="post" action="pdf/presu.php" target="_blank"><h5>Sacar Presupuesto</h5><button type="submit" class="btn btn-warning" name="id_or" value="'.$id_or.'">Imprimir</button>
             </form>
             <hr/>
             <form id="delete_or" method="post" action="pro_eliminar_or.php">
             <button id="ref" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Eliminar Orden</button>
             
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
        <p>Eliminar Orden?</p><h4>'.$numero_or.'</h4>
        <p> Introdusca el N° de Orden para Confirmar</p>
        <input type="text" name="conf_numero_or" class="form-control" placeholder="N&uacute;mero de OR" maxlength="11" required>
        <input type="hidden" name="id_or" value="'.$id_or.'" required>
        <input type="hidden" name="numero_or" value="'.$numero_or.'" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar Orden</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
</form>
              <br><div id="que"></div>';
             }else{

echo  '<form name="formpdf" method="post" action="pdf/o_r1.php" target="_blank"><input type="hidden" name="id_or" value="'.$id_or.'"><button type="submit" class="btn btn-info">Imprimir OR</button></form>&nbsp;';
if ($imp==0) {
 echo '<br><form name="formfacturar" method="GET" action="imprimir_factura_or.php"><input type="hidden" name="id_or" value="'.$id_or.'"><button type="submit" class="btn btn-warning">Imprimir Factura</button></form>';
}

             }

             echo '</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>';
        ?>
<style>
#totales{
position: fixed;
bottom: 0px;
left: 0px;
z-index: 100000000000000;
color:#FFF;
min-height: 25px;
background-color: #0099FF;

}
</style>
        <?php
 $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
      $fecha_entrada = strtotime("20-08-2018 00:00:00");
      if($fecha_actual < $fecha_entrada){

        echo '<div id="totales" class="callout callout-info">
<h5>Sub-Total : '.number_format(total_or($id_or),2,",",".").' Bs<br>
IVA&nbsp;'.$iva.'%:&nbsp;'.number_format(((total_or($id_or)*$iva)/100),2,",",".").'&nbsp;Bs<br>
Total:&nbsp;'.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").'&nbsp;Bs<br>
Pagos: '.number_format(total_abono($id_or),2,",",".").' Bs<br> Resta Sin IVA: '.number_format((total_or($id_or)-(total_abono($id_or))),2,",",".").'&nbsp;Bs<br>Resta con IVA: &nbsp;'.number_format((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)),2,",",".").'&nbsp;Bs
</h5>
<hr/>
Sub-Total:&nbsp;'.number_format((total_or($id_or))/100000,2,",",".").'&nbsp;Bs. S.<br>
IVA&nbsp;'.$iva.'%:&nbsp;'.number_format((((total_or($id_or)*$iva)/100))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.<br>
Total:&nbsp;'.number_format(((total_or($id_or)+((total_or($id_or)*$iva)/100)))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.<br>
Pagos:&nbsp;'.number_format((total_abono($id_or))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.<br>Resta Sin IVA:&nbsp;'.number_format(((total_or($id_or)-(total_abono($id_or))))/100000,2,",",".").'&nbsp;Bs<br>Resta con IVA: &nbsp;'.number_format(((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.
</div>';
}else {
        echo '<div id="totales" class="callout callout-info">
<h4>Sub-Total:&nbsp;'.number_format((total_or($id_or))/100000,2,",",".").'&nbsp;Bs. S.<br>
IVA&nbsp;'.$iva.'%:&nbsp;'.number_format((((total_or($id_or)*$iva)/100))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.<br>
Total:&nbsp;'.number_format(((total_or($id_or)+((total_or($id_or)*$iva)/100)))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.<br>
Pagos:&nbsp;'.number_format((total_abono($id_or))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.<br>Resta Sin IVA:&nbsp;'.number_format(((total_or($id_or)-(total_abono($id_or))))/100000,2,",",".").'&nbsp;Bs<br>Resta con IVA: &nbsp;'.number_format(((total_or($id_or)+(total_or($id_or)*$iva)/100)-(total_abono($id_or)))/100000,2,",",".").'&nbsp;Bs.&nbsp;S.
</h4></div>';
}



}
}
}
?>
<script src="plugins/select2/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
$(function () {
    //Initialize Select2 Elements
$(".select2").select2();
});
</script>
<script>
  $(document).ready(function(){
        $("#delete_or").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("delete_or"));
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
    $("#example3").DataTable();
     $("#example4").DataTable();
    $("#example5").DataTable();
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
<script>
  $(function () {
     //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
</script>