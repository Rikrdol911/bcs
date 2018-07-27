<?php session_start();
if (isset($conectar)){
	date_default_timezone_set("America/Barbados");
$servidor="localhost";
	$usuarios="root";
	$password="";
	$db="bcs";
	$conexion=mysqli_connect($servidor,$usuarios,$password) or die("Error conectando...");
	mysqli_select_db($conexion,$db) or die("No consigue la base de datos");
	$_SESSION['conexion_database']=$conexion;
}else{
}
function cons($var){
$ret= mysqli_query($_SESSION['conexion_database'],$var) or die(mysqli_error($_SESSION['conexion_database']));
return $ret;	
}
?>
<?php
function positivo($valor){
$var='<div class="alert alert-success alert-dismissible des">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$valor.'</div>';	
				return $var;	
}
function negativo($valor){
$var='<div class="alert alert-danger alert-dismissible des">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$valor.' </div>';
				return $var;	
}
function alerta($valor){
$var='<div class="alert alert-info alert-dismissible des">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$valor.' </div>';
				return $var;	
	
}

function total_or($id_or){
$consulta=("SELECT * FROM o_r WHERE id_or='$id_or' LIMIT 1");
$f=cons($consulta);
$todo=0;
$total_or=0;
while($row=mysqli_fetch_array($f)){
 $titulo=unserialize($row['array_titulo']);
 $mano_obra=unserialize($row['array_mano_obra']);
  $horas=unserialize($row['array_horas']);
  $precios=unserialize($row['array_precio']);
  $garantia=unserialize($row['array_garantia']);
  foreach($titulo as $numero => $id_mano){
$prec=$precios[$numero];
$garant=$garantia[$numero];
if($garant==0){
  $total_or=($total_or+$prec);
}

  }
}
$total_repuestos=0;
$consu=("SELECT * FROM repuesto_or WHERE id_or='$id_or' AND habilitado=0");
$co=cons($consu);
while($ro=mysqli_fetch_array($co)){
$cant=$ro['cantidad'];
$prec=$ro['precio'];
$taller=$ro['taller'];
if($taller==0){
$total_repuestos=($total_repuestos+($cant*$prec));
}
    }
$total_servicios=0;
$consulta=("SELECT * FROM servicios_or WHERE id_or='$id_or' AND habilitado=0");
$r=cons($consulta);
while($ros=mysqli_fetch_array($r)){
$total_servicios=($total_servicios+$ros['monto']);
    }

$todo=(($total_or+$total_repuestos)+$total_servicios);

return $todo;
}
function total_abono($id_or){
$total_abon=0;
$consulta5=("SELECT * FROM abono_or WHERE id_or='$id_or' AND habilitado=0");
$r5=cons($consulta5);
while($ros5=mysqli_fetch_array($r5)){
$total_abon=($total_abon+$ros5['monto']);
    }
return $total_abon;
  }

  function filtroxss($val) {
        // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
        // this prevents some character re-spacing such as <java\0script>
        // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
        $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
 
        // straight replacements, the user should never need these since they're normal characters
        // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            // ;? matches the ;, which is optional
            // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
 
            // &#x0040 @ search for the hex values
            $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
            // @ @ 0{0,7} matches '0' zero to seven times
            $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
        }
 
        // now the only remaining whitespace attacks are \t, \n, and \r
        $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title');
        $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);
 
        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
                        $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
                        $pattern .= ')?';
                }
                $pattern .= $ra[$i][$j];
             }
             $pattern .= '/i';
             $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
             $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
             if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
             }
          }
        }
 
 
 
 
        return mysqli_real_escape_string($_SESSION['conexion_database'],$val);
    }
// Aqui le quite AND taller=0 porque hay entrada de repuestos por inventario que son de clientes
function cantidad($id_pieza){
$total2=0;
$consulta=("SELECT id_factura FROM factura WHERE (habilitado=0 OR habilitado=3)");
$r=cons($consulta);
while($row=mysqli_fetch_array($r)){
$id_factura=$row['id_factura'];
$consulta2=("SELECT cantidad FROM detalle_factura WHERE id_pieza='$id_pieza' AND id_factura='$id_factura'");
$r2=cons($consulta2);
while($row2=mysqli_fetch_array($r2)){
   $total2=$total2+$row2['cantidad']; 
}
}
$total3=0;
$consulta=("SELECT cantidad FROM inventario WHERE id_pieza='$id_pieza' AND (habilitado=0 OR habilitado=3)");
$r=cons($consulta);
while($row=mysqli_fetch_array($r)){
   $total3=$total3+$row['cantidad']; 
}
$total1=0;
$consulta_or1=("SELECT * FROM repuesto_or WHERE id_pieza='$id_pieza' AND habilitado=0");
$f_or1=cons($consulta_or1);
while($row_or1=mysqli_fetch_array($f_or1)){
  $total1=$total1+$row_or1['cantidad']; 
}
$restar=($total1+$total2);
$cantidad=($total3-$restar);

    return $cantidad;
}
function DescargarArchivo($fichero){
$basefichero = basename($fichero);
header( 'Content-Type: application/octet-stream');

header( 'Content-Length:'.filesize($fichero));

header( 'Content-Disposition:attachment;filename='.$basefichero.'');
readfile($fichero);
}
?>
