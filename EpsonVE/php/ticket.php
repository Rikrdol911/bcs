<?php

  dl("php_tm20v52ts.dll");

  $err = IF_OPEN("COM2",9600);

  if ( $err != 0) 
  {   echo "impresora ocupada";   return;  }

  $err = IF_WRITE("@OpenFiscalReceipt");
  $err = IF_WRITE("@PrintFiscaltext|URB. BRISAS DEL SUR|S");
  $err = IF_WRITE("@PrintFiscaltext|VEND: 01       CAJA:  1|S");
  $err = IF_WRITE("@PrintFiscaltext|006095 LIBRO ANA ISA|S");
  $err = IF_WRITE("@PrintLineItem|BEL UNA NINA DECENTE|0001|00000008.00|.00|M");
  $err = IF_WRITE("@Subtotal");
  $err = IF_WRITE("@CloseFiscalReceipt");
printf($err);
  $err =IF_CLOSE();

?>
