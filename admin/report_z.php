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
        <li class="active">Reporte Z</li>
      </ol>
    </section>
  <!-- /.Content Header (Page header) -->

<!-- Main content -->
<section class="content">
<?php
if(isset($_SESSION['ingreso'])){
	echo '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Imprimir Reporte</h3>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form id="formulario" role="form" method="POST" enctype="multipart/form-data" action="../EpsonVE/php/cierrez1.php">
              <div class="box-body">

          <!-- Documento Nacional de Identidad -->
          <div class="col-lg-12 col-md-12 col-xs-10">
			    <div class="form-group">
                  <label for="fecha">Fecha de Hoy</label>
                  <input type="date" name="fecha" class="form-control" required>
<!-- Btn Envio -->
              <div class="box-footer text-center">
                <button type="submit" id="ref" class="btn btn-primary">Cierre Z</button>
              </div>
              <!-- /.btn envio -->

            </form>
            <!-- /.formulario cliente -->
          </div>';
		  echo "<div id='clearfix'></div>";
		}	
?>

</section>
</div>
    <?php
include("footer.php");
?>