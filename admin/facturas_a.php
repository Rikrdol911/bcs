<?php include("menu.php");
?>
 <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="cierre_a.php"><i class="fa fa-dashboard"></i> Volver</a></li>
        <li class="active">Ver Factura</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
<?php
if(isset($_SESSION['ingreso'])){
if(isset($_GET['n_fac'])){
if(isset($_GET['id_proveedor'])){

$id_proveedor=filtroxss($_GET['id_proveedor']);
$n_factura=filtroxss($_GET['n_fac']);	
echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Factura #'.$n_factura.'</b></h3>
            </div>';
			$consu=("SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor' LIMIT 1");
			$dv=cons($consu);
			while($ro=mysqli_fetch_array($dv)){
      $id_tipo=$ro['id_tipo'];
			$nombre_proveedor=$ro['nombre'];
			$rif=$ro['rif'];	
			$telefono=$ro['telf'];	
      $consu2=("SELECT * FROM tipo WHERE id_tipo='$id_tipo' LIMIT 1");
      $dv2=cons($consu2);
      while($ro2=mysqli_fetch_array($dv2)){
        $nombre_tipo=$ro2['nombre'];
      }
			}
			echo "<div class='box-body'>Proveedor: <b><a href='perfil_proveedor.php?id=".$id_proveedor."'>".$nombre_proveedor."</a></b><br>RIF: <b>".$nombre_tipo."-".$rif."</b><br>Telefono: <b>".$telefono."</b><br><br>";
$consulta=("SELECT * FROM inventario WHERE id_proveedor='$id_proveedor' AND n_factura='$n_factura' AND habilitado=0");
$f=cons($consulta);
if(mysqli_num_rows($f)<=0){
echo alerta("No existe la factura");	
}else{
	echo '<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Inventario</th>
                  <th>Rango</th>
                  <th>Pieza</th>
                  <th>Fecha</th>
                  <th>Cantidad</th>
				  <th>Precio Bs</th>
				  <th>Total Bs</th>
                </tr>
                </thead>
                <tbody id="prep">';
				$total_factura=0;
	while($row=mysqli_fetch_array($f)){
		$id_pieza=$row['id_pieza'];
		$fc=("SELECT * FROM pieza WHERE id_pieza='$id_pieza' LIMIT 1");
		$v=cons($fc);
		while($ts=mysqli_fetch_array($v)){
			$id_rango=$ts['id_rango'];
			$nombre_pieza=$ts['nombre'];
		}
		    $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
      $fecha_entrada = strtotime("20-08-2018 00:00:00");
      if($fecha_actual < $fecha_entrada){
echo '<tr>
    <td>'.$nombre_rango.'</td>
    <td>'.$referencia.'</td>
    <td>'.$nombre_pieza.'</td>
    <td>'.$row['fecha'].'</td>
    <td>'.$row['cantidad'].'</td>
    <td>'.number_format(($row['precio']),2,",",".").' BsF || '.number_format(($row['precio']/100000),2,",",".").' Bs S.</td>
    <td>'.number_format(($row['cantidad']*$row['precio']),2,",",".").' BsF ||'.number_format(($row['cantidad']*$row['precio'])/100000,2,",",".").' Bs S.</td>
    </tr>';
    $total_factura=($total_factura+($row['cantidad']*$row['precio']));
    $total_factura2=($total_factura2+($row['cantidad']*$row['precio'])/100000);
      }else {
    echo '<tr>
    <td>'.$nombre_rango.'</td>
    <td>'.$referencia.'</td>
    <td>'.$nombre_pieza.'</td>
    <td>'.$row['fecha'].'</td>
    <td>'.$row['cantidad'].'</td>
    <td>'.$row['precio'].'</td>
    <td>'.number_format(($row['cantidad']*$row['precio']),2,",",".").'</td>
    </tr>';
    $total_factura=$total_factura+($row['cantidad']*$row['precio']);
   
  }
}
	echo ' </tbody>
                <tfoot>
                <tr>
                    <th>ID Inventario</th>
                  <th>Rango</th>
                  <th>Pieza</th>
                  <th>Fecha</th>
                  <th>Cantidad</th>
				  <th>Precio Bs</th>
				  <th>Total Bs</th>
                </tr>
                </tfoot>
              </table>';
			                if($fecha_actual < $fecha_entrada){
        echo "<h3>TOTAL DE FACTURA: ".number_format($total_factura,2,",",".")." Bs</h3>";
        echo "<h3>TOTAL DE FACTURA: ".number_format($total_factura2,2,",",".")." Bs S.</h3>";
      }
    else{
      echo "<h3>TOTAL DE FACTURA: ".number_format($total_factura,2,",",".")." Bs</h3>";
    }
}
echo "</div></div>";

}
}
}
include("footer.php");
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