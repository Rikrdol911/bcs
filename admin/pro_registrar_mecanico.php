<?php $conectar=TRUE; include("conexion.php");
if(isset($_SESSION['ingreso'])){
if(isset($_POST['tipo'])){
if(isset($_POST['dni'])){
if(is_numeric($_POST['dni'])){
if(isset($_POST['nombre'])){	
$tipo=filtroxss($_POST['tipo']);
$dni=filtroxss($_POST['dni']);
$nombre=filtroxss(strtoupper($_POST['nombre']));
if(($tipo=="") || ($dni=="") || ($nombre=="")){
	echo negativo("Uno de los campos esta vacio. Intentalo nuevamente!");
exit;	
}
$consulta=("SELECT * FROM mecanico WHERE dni='$dni' AND habilitado=0 LIMIT 1");
$d=cons($consulta);
if(mysqli_num_rows($d)>=1){
echo negativo("El Mec&aacute;nico ya se encuentra registrado.");
exit;	
}
$insr=("INSERT INTO mecanico (dni,nombre,habilitado)
VALUES ('$dni','$nombre',0)");
cons($insr);
if(mysqli_affected_rows($_SESSION['conexion_database'])<=0){
echo negativo("Hubo un error general, intentalo nuevamente");	
}else{
echo positivo("Has registrado el Mec&aacute;nico: ".$nombre." exitosamente.");
$id=mysqli_insert_id($_SESSION['conexion_database']);
$coq='<tr><td>'.$nombre.'</td></tr>';
?>
<script>
$("#formulario").trigger("reset");
$('#example1 tr:first').after('<?php echo $coq;?>');
</script>
<?php
}
}
}else{
	echo negativo("El documento debe tener solo n&uacute;meros");
}
}
}
}	
?>