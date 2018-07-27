<?php
  //dl("php_tm20v52ts.dll");
  $err = IF_OPEN("COM2",9600);
  if ( $err != 0) 
  {   echo "impresora ocupada o error en la  apertura de puerto";   return;  }
  $err = IF_WRITE("@OpenFiscalReceipt|ARMAS REINALDO.|5981854");
 $err = IF_WRITE("@PrintLineItem|HABITACION|0001|00000001.00|.09|M");
  $err = IF_WRITE("@PrintLineItem|Lavanderia|0001|00000000.50|.09|M");
  $err = IF_WRITE("@Subtotal");
  $err = IF_WRITE("@CloseFiscalReceipt|A|");
  $err = IF_WRITE("@PrintFiscaltext|CARACAS, DISTRITO CAPITAL.|S");
  $err = IF_WRITE("@PrintFiscaltext|VENEZUELA.|S");
  $err = IF_WRITE("@PrintFiscaltext|F/LLEGADA:21/04/2007|S");
  $err = IF_WRITE("@PrintFiscaltext|SUMATORIA ABONOS BS|S");
  $err = IF_WRITE("@PrintFiscaltext|A PAGAR BS|S");
  $err = IF_WRITE("@CloseFiscalReceipt");
  $err = IF_CLOSE();
?>
