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
        <li class="active">Imprimir Orden de Reparaci&oacute;n</li>
      </ol>
    </section>
<!-- /.Content Header (Page header) -->
 <!-- Main content -->
    <section class="content">
<?php
if(isset($_GET['id_or'])){
if(is_numeric($_GET['id_or'])){
$id_or=filtroxss($_GET['id_or']);
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' AND habilitado=0 AND imp=0 LIMIT 1");
  $v=cons($consulta);
  if(mysqli_num_rows($v)<=0){
echo negativo("La OR no existe o ya se facturo");
include("footer.php");
    exit;
  }
while($rf=mysqli_fetch_array($v)){
    $id_cliente=$rf['id_cliente'];
    $imp=$rf['imp'];
    $fecha_cierre1=$rf['fecha_cierre'];
if ($fecha_cierre1=="000-00-00") {
	echo negativo("La Orden no se ha cerrado");
	exit;
}
$explode1=explode('-', $fecha_cierre1);
$fecha_cierre12=$explode1[2]."/".$explode1[1]."/".$explode1[0];
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>IMPRIMIR A NOMBRE DE:</b></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" target="_blank" action="../EpsonVE/php/facturar_orden.php">
              <div class="box-body">
              <input type="hidden" name="id_or" value="'.$id_or.'">
          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Tipo de Documento">Tipo de Documento</label>
                  <select class="form-control" name="tipo" required>';
$consulta=("SELECT * FROM cliente WHERE id_cliente='$id_cliente' AND habilitado=0 LIMIT 1"); 
$ds=cons($consulta);
if(mysqli_num_rows($ds)<=0){
echo negativo("Error en cliente");
  exit;
}
while($g=mysqli_fetch_array($ds)){
$id_tipo=$g['id_tipo'];
$nombre_cliente=$g['nombre'];
$dni=$g['dni'];
}
$id_carro=$rf['id_carro'];
$con=("SELECT * FROM carro WHERE id_carro='$id_carro' AND habilitado=0 LIMIT 1");
$d=cons($con);
if(mysqli_num_rows($d)<=0){
echo negativo("No existe el carro");
  exit;
}
while($f=mysqli_fetch_array($d)){
$placa=$f['placa'];
$modelo=$f['modelo'];

}

$consultaa=("SELECT * FROM tipo");
$da=cons($consultaa);
while($rowa=mysqli_fetch_array($da)){
  $elti=$rowa['id_tipo'];
  if($elti==$id_tp){
    echo "<option selected value=".$rowa['id_tipo'].">".$rowa['nombre']."</option>";  
  }else{
echo "<option value=".$rowa['id_tipo'].">".$rowa['nombre']."</option>"; 
  }
}
              echo '</select>
                </div>
                </div>
        <div class="col-lg-4 col-md-4 col-xs-10">
        <div class="form-group">
                  <label for="Documento">Documento</label>
                  <input type="text" maxlength="10" class="form-control" placeholder="Ingresa el documento de identidad" name="dni" value="'.$dni.'" required>
                </div>
                </div>
                <!-- /.Documento Nacional de Identidad -->

                 <!-- Nombre de Cliente -->
                <div class="col-lg-4 col-md-4 col-xs-10">
          <div class="form-group">
                  <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Ingresa el nombre del cliente" name="nombre" value="'.$nombre_cliente.'" maxlength="26" required>
                </div>
                </div>
                <div class="form-group">
                  <label for="Nombre">Direccion</label>
                  <textarea class="form-control" placeholder="Ingresa la direccion corta del cliente" id="nombre" name="direccion" required></textarea>
                </div>
                <!-- /.Nombre de Cliente -->
                </div>';
          if ($imp==1) {
          echo negativo("Esta factura ya se ha impreso");           
          }else{ echo '<div class="box-footer text-center" id="aparecer">
                <button type="submit" id="generar" class="btn btn-info">Generar Factura</button>
                </div>';}
               
               echo '</form><hr/><form action="factura_orden_impresa.php" id="formulario22" role="form" method="POST" enctype="multipart/form-data"><input type="hidden" name="id_or" value="'.$id_or.'"><div class="text-center" id="contenedor"></div></form><br></div>';

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

            <div class="box-body"> 
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripcion</th>
                  <th>Horas</th>
                  <th>Precio</th>
                  <th>Garant.</th>                  
                </tr>
                </thead>
                <tbody id="prep">';
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$f=cons($consulta);
while($row=mysqli_fetch_array($f)){
  $titulo=unserialize($row['array_titulo']);
  $mano_obra=unserialize($row['array_mano_obra']);
  $horas=unserialize($row['array_horas']);
  $precios=unserialize($row['array_precio']);
  $garantia=unserialize($row['array_garantia']);
  $iva=$row['iva'];
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
foreach($la_mano as $nume =>$id_descripcion){
  $cond=("SELECT * FROM descripcion_mano_de_obra WHERE id_descripcion='$id_descripcion' LIMIT 1");
  $a=cons($cond);
  while($fds=mysqli_fetch_array($a)){
    echo "&nbsp;&nbsp;&nbsp;-<b>".$fds['nombre']."</b><br>";
  }
}
echo '</td>';
echo '<td>'.$horas[$numero].'</td>';
echo '<td>'.number_format($precios[$numero],2,",",".").' Bs</td>';
$garant=$garantia[$numero];
if($garant==0){
  echo "<td>No</td>";
}else{
 echo '<td>Si</td>'; 
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
        	';
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
echo '<table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio Bs</th>
                  <th>Total</th>
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
echo '<td>'.number_format($prec,2,",",".").'<td>'.number_format(($cant*$prec),2,",",".").' Bs</td>';
}else{
echo '<td>Traido Por Cliente</td><td>Traido Por Cliente</td>';
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
echo '<br><br><table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N° Factura</th>
                  <th>Pro. Servicio</th>
                  <th>Descripci&oacute;n</th>
                  <th>Monto</th>
                  <th>Costo del Servicio</th>
                </tr>
                </thead>
                <tbody id="prep4">';
$consulta=("SELECT * FROM servicios_or WHERE id_or='$id_or'");
$r=cons($consulta);
while($ros=mysqli_fetch_array($r)){
echo '<tr id="w'.$ros['codigo'].'"><td>'.$ros['codigo'].'</td><td>'.$ros['nombre_servicio'].'</td><td>'.$ros['descripcion'].'</td><td>'.number_format($ros['monto'],2,",",".").'</td><td>'.number_format($ros['costo_servicio'],2,",",".").'</td>';
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
        </div>

  
          </div>
          <!-- /.box -->
      ';
 }

echo '<!-- /.box -->
        </div>';

?>
</section>
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
        echo '<div id="totales" class="callout callout-info">
<h4>Sub-Total : '.number_format(total_or($id_or),2,",",".").' Bs<br>IVA '.$iva.'%: '.number_format(((total_or($id_or)*$iva)/100),2,",",".").' Bs<br>Total: '.number_format((total_or($id_or)+((total_or($id_or)*$iva)/100)),2,",",".").' Bs</h4>
              </div>';
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
<script>
  $(document).ready(function(){
        $("#formulario22").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario22"));
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
<?php
}
include("footer.php");
?>