<?php include("menu.php");
if(isset($_SESSION['ingreso'])){
$ano=date("Y");
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel Administrativo
        <small>Version 1.0 BETA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="salir.php"><i class="fa fa-dashboard"></i> Salir</a></li>
        <li class="active">Panel Administrativo</li>
      </ol>
    </section>
 	<!-- /.Content Header (Page header) -->

<!-- Main content -->
    <section class="content">
     
      <!-- ROW -->
      <div class="row">
       <!-- Info boxes -->
 		 <div class="col-md-4 col-sm-6 col-xs-12">
 		 <a href="ordenes_or.php">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ordenes de Reparaci&oacute;n Abiertas</span>
              <?php 
              $consultaoa=("SELECT COUNT(id_or) FROM o_r WHERE fecha_cierre='000-00-00'");
                $dinv=cons($consultaoa);
                while($rowinv=mysqli_fetch_array($dinv)){
                $ordenes_abiertas=$rowinv['COUNT(id_or)']; 
                }
              ?>
              <span class="info-box-number"><?php echo $ordenes_abiertas;?><small> Totales</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>  

         <!-- info-box -->
         <div class="col-md-4 col-sm-6 col-xs-12">
 		 <a href="ordenes_or.php">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-android-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Hist&oacute;rico de Veh&iacute;culos</span>
              <?php
               $consultao_r1=("SELECT COUNT(id_or) FROM o_r WHERE habilitado=0");
                $dinv1=cons($consultao_r1);
                while($rowinv1=mysqli_fetch_array($dinv1)){
                $ordenes_cerradas=$rowinv1['COUNT(id_or)']; 
                }
              ?>
              <span class="info-box-number"><?php echo $ordenes_cerradas; ?><small> Registrados</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>  

         <!-- info-box -->
         <div class="col-md-4 col-sm-6 col-xs-12">
 		 <a href="ver_facturar.php">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ventas de Repuestos</span>
              <?php 
              $consultave=("SELECT COUNT(id_factura) FROM factura WHERE habilitado=0");
                $dinve=cons($consultave);
                while($rowinve=mysqli_fetch_array($dinve)){
                $ventas=$rowinve['COUNT(id_factura)']; 
                }
                ?>
              <span class="info-box-number"><?php echo $ventas; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>  	

         <!-- info-box -->
         <div class="col-md-4 col-sm-6 col-xs-12">
 		 <a href="inventario.php">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-android-desktop"></i></span>
<?php
$total3=0;
$total2=0;

$consulta3=("SELECT * FROM inventario WHERE habilitado=0");
$r3=cons($consulta3);
while($row3=mysqli_fetch_array($r3)){
 $total3=$total3+$row3['cantidad']; //Cantidad de la pieza en inventario
 $id_pieza1=$row3['id_pieza'];
$consulta=("SELECT * FROM factura WHERE (habilitado=0 OR habilitado=3)");
$r=cons($consulta);
while($row=mysqli_fetch_array($r)){
$id_factura2=$row['id_factura'];
$consulta4=("SELECT * FROM detalle_factura WHERE id_pieza='$id_pieza1' AND id_factura='$id_factura2'");
$r4=cons($consulta4);
while($row4=mysqli_fetch_array($r4)){
  $total2=$total2+$row4['cantidad']; 
}
}
}
$consulta_or=("SELECT * FROM o_r WHERE (habilitado=0 OR habilitado=3)");
$f_or=cons($consulta_or);
$total1=0;
while($row_or=mysqli_fetch_array($f_or)){
$consulta_or1=("SELECT * FROM repuesto_or WHERE id_pieza='$id_pieza1' AND habilitado=0");
$f_or1=cons($consulta_or1);
while($row_or1=mysqli_fetch_array($f_or1)){
  $total1=$total1+$row_or1['cantidad']; 
}
}
$restar=($total1+$total2);
$cantidad=($total3-$restar);
?>
            <div class="info-box-content">
              <span class="info-box-text">Inventario</span>
              <span class="info-box-number"><?php echo $cantidad; ?><small> Repuestos</small><br></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>  
   <!-- BAR CHART -->
   <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="box box-info text-center">
                <div class="box-header">
                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>

                <div class="box-body">
                 <h3 class="box-title text-center">Ventas y &Oacute;rdenes Por Mes</h3>
                  <div class="chart">
                    <canvas id="barChart"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
</div>



      </div>
      <!-- /.ROW -->
      </section>
      <!-- /.Main content -->




    <!-- /.Content Wrapper. Contains page content -->
    </div>
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- page script -->
<?php
$fe1=$ano."-01-01";
$fe2=$ano."-12-31";
$col=("SELECT * FROM factura WHERE habilitado=0 AND fecha BETWEEN date('$fe1') AND date('$fe2')");
$d=cons($col);
$array=array(0,0,0,0,0,0,0,0,0,0,0,0);

while($g=mysqli_fetch_array($d)){
$fes=explode('-',$g['fecha']);
$fh=$fes[1];
if($fh==1){
  $array[0]=($array[0]+1);
}
if($fh==2){
  $array[1]=($array[1]+1);
}
if($fh==3){
  $array[2]=($array[2]+1);
}
if($fh==4){
  $array[3]=($array[3]+1);
}
if($fh==5){
  $array[4]=($array[4]+1);
}
if($fh==6){
  $array[5]=($array[5]+1);
}
if($fh==7){
  $array[6]=($array[6]+1);
}
if($fh==8){
  $array[7]=($array[7]+1);
}
if($fh==9){
  $array[8]=($array[8]+1);
}
if($fh==10){
  $array[9]=($array[9]+1);
}
if($fh==11){
  $array[10]=($array[10]+1);
}
if($fh==12){
  $array[11]=($array[11]+1);
}
}         
 ?>
<?php
$fe3=$ano."-01-01";
$fe4=$ano."-12-31";
$col1=("SELECT * FROM o_r WHERE (habilitado=0 OR habilitado=3) AND fecha_cierre BETWEEN date('$fe3') AND date('$fe4')");
$d1=cons($col1);
$array1=array(0,0,0,0,0,0,0,0,0,0,0,0);
while($g1=mysqli_fetch_array($d1)){
$fes1=explode('-',$g1['fecha_cierre']);
$fh1=$fes1[1];
if($fh1==1){
  $array1[0]=($array1[0]+1);
}
if($fh1==2){
  $array1[1]=($array1[1]+1);
}
if($fh1==3){
  $array1[2]=($array1[2]+1);
}
if($fh1==4){
  $array1[3]=($array1[3]+1);
}
if($fh1==5){
  $array1[4]=($array1[4]+1);
}
if($fh1==6){
  $array1[5]=($array1[5]+1);
}
if($fh1==7){
  $array1[6]=($array1[6]+1);
}
if($fh1==8){
  $array1[7]=($array1[7]+1);
}
if($fh1==9){
  $array1[8]=($array1[8]+1);
}
if($fh1==10){
  $array1[9]=($array1[9]+1);
}
if($fh1==11){
  $array1[10]=($array1[10]+1);
}
if($fh1==12){
  $array1[11]=($array1[11]+1);
}
}
?>
    <script>
     $(document).ready(function(){
      $(function () {
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var areaChartData = {
          labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
          datasets: [
            {
              label: "Ventas Por Mostrador",
              fillColor: "#f39c12",
              strokeColor: "#f39c12",
              pointColor: "#f39c12",
              pointStrokeColor: "#f39c12",
              pointHighlightFill: "#f39c12",
              pointHighlightStroke: "#f39c12",
              data: [<?php echo implode(',',$array); ?>]
            },
            {
              label: "Órdenes de Reparación",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php echo implode(',',$array1); ?>]
            }
          ]
        };
         var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#3c8dbc";
        barChartData.datasets[1].strokeColor = "#3c8dbc";
        barChartData.datasets[1].pointColor = "#3c8dbc";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
});
</script>
<?php
}
include("footer.php");
?>