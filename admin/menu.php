<?php $conectar=TRUE; include("conexion.php");?><!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bosch Car Service</title>
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bootstrap/fonts/font-awesome.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/ionicons.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
$(document).ready(function(){
$('.formulario').submit(function() {
 
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
 <script>
$(document).ready(function(){
$('#buscador').submit(function() {
 
  // Enviamos el formulario usando AJAX

        $.ajax({
      async: true,   
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#resultado').html(data);
            }
  })       
        return false; 
    }); 
});

</script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<style>
#respuesta{
	position:fixed;
	right:0px;
	bottom:0px;
	z-index:12000000;
	
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div id='respuesta'></div>
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>CS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bosch</b> Car Service</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre'];?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          <?php
          $datelog=date('d/m/Y');
          $timelog=date('h:i:s a');
          echo $datelog."<br>&nbsp;&nbsp;".$timelog;
           ?>
        </div>
      </div>

   <!-- search form (Optional) -->
      <form id="buscador" method="get" class="sidebar-form" action="buscar.php">
        <div class="input-group">
          <input type="text" name="dato" class="form-control" placeholder="Buscar..." required="required">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
         <!-- Clientes -->
        <li class="treeview">
          <a href="registrar_cliente.php"><i class="glyphicon glyphicon-user"></i> <span>Clientes</span>
     
          </a>

        </li>
         <!-- /.Clientes -->

        <!-- Vehiculos -->
        <li class="treeview1">
          <a href="registrar_carro.php"><i class="glyphicon glyphicon-scale"></i> <span>Veh&iacute;culos</span>
          </a>
  
        </li>
        <!-- /.Vehiculos -->
        <!-- Proveedores -->
        <li class="treeview2">
          <a href="proveedores.php"><i class="glyphicon glyphicon-briefcase"></i> <span>Proveedores</span>
          </a>
  
        </li>
        <li class="treeview2">
          <a href="#">
            <i class="glyphicon glyphicon-list"></i> <span>Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="registrar_inventario.php"><i class="glyphicon glyphicon-plus"></i> <span>Registrar</span>
            <li><a href="inventario.php"><i class="glyphicon glyphicon-search"></i> Ver</a></li>
            <li><a href="pdf/inventario_all.php" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Imprimir Inventario</a></li>  
          </ul>
        </li>
        <!-- OR -->
       <li class="treeview2">
          <a href="ordenes_or.php"><i class="glyphicon glyphicon-barcode"></i> <span>OR</span>
          </a>
        </li>
        <!-- ./OR -->
        <!-- Ventas -->
            <li class="treeview2">
          <a href="#">
            <i class="glyphicon glyphicon-list"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="facturar.php"><i class="glyphicon glyphicon-plus"></i> <span>Nueva Venta</span>
            <li><a href="ver_facturar.php"><i class="glyphicon glyphicon-search"></i> Ver Ventas</a></li>
          </ul>
        </li>
          </a>
        <!-- /.OR -->
        </li>
        <!-- /.Proveedores -->
<!-- Gestiones -->
        <li class="treeview2">
          <a href="#">
            <i class="glyphicon glyphicon-cog"></i> <span>Gestionar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="tra_mano.php"><i class="glyphicon glyphicon-plus"></i> Trab. Mano Obra</a></li>
            <li><a href="meca.php"><i class="glyphicon glyphicon-user"></i> Mecanico</a></li>
            <li><a href="ver_pieza.php"><i class="glyphicon glyphicon-edit"></i> Editar Pieza</a></li>
            <li><a href="new_rango.php"><i class="glyphicon glyphicon-plus"></i> Nuevo Rango</a></li>
          </ul>
        </li>
        <!-- /.Gestiones -->
        <!-- Contable -->
        <li class="treeview2">
          <a href="#">
            <i class="glyphicon glyphicon-paste"></i> <span>Contabilidad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
            <li><a href="cierre_a.php"><i class="glyphicon glyphicon glyphicon-pushpin"></i> Cierre de A&ntilde;o</a></li>
            <li><a href="fiscal_actual1.php"><i class="glyphicon glyphicon-pushpin"></i> Año en Curso</a></li>
          </ul>
        </li>
        <!-- /.Contabilidad -->
        <!-- Salir -->
        <li><a href="salir.php"><i class="glyphicon glyphicon-off"></i> <span>Salir</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
      <?php 
      $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
      $fecha_entrada = strtotime("01-07-2018 00:00:00");
      if($fecha_actual < $fecha_entrada){
           echo ' <div class="alert alert-warning alert-dismissible des">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>AVISO:
                  <p>Desde el 1 de Mayo ver&aacute;s en los precios de siempre, y tambi&eacute;n el nuevo formato de Bol&iacute;vares Soberanos (Bs.S.)</p>
       <p>Desde el 4 de Agosto S&oacute;lo verás los montos en Bol&iacute;vares Soberanos</p></div>';
}else{
     
}
 

                ?>
    </section>
    <!-- /.sidebar -->
  </aside>
   <!-- Modal -->
<div id="myModal2" class="modal fade col-lg-offset-1 col-md-offset-1 col-xs-offset-0  bs-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Resultados</h3>
      </div>
      <div class="modal-body">
      <div id="resultado"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
        </div>
        </div>



 
    
 