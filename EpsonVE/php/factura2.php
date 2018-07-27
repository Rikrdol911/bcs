<?php
$err = IF_OPEN("COM2",9600);
 if ( $err != 0) 
  {   echo "impresora ocupada";   return;  }
$nError = 0; 		
$strBuff= "@OpenFiscalReceipt|BILLARES AJA C.A.|J302551480";	
$nError = IF_WRITE($strBuff);
$nError = 0; 		
$strBuff= "@CloseFiscalReceipt";	
$nError = IF_WRITE($strBuff);
$nError = 0; 		
$strBuff= "@PaperCut";	
$nError = IF_WRITE($strBuff);

?>