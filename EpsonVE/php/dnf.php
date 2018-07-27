<?php

  dl("php_tm20v52ts.dll");

  $err = IF_OPEN("COM2",9600);

  if ( $err != 0) 
  {   echo "impresora ocupada";   return;  }

  $err = IF_WRITE("@OpenNonfiscalReceipt");
  $err = IF_WRITE("@PrintNonfiscalText|VENECAL C.A. RIF:J-00000000-8");
  $err = IF_WRITE("@PrintNonfiscalText|Calle Brasil Centro Brasil PB Catia,");
  $err = IF_WRITE("@PrintNonfiscalText|Caracas, Tel:0212-0000000");
  $err = IF_WRITE("@PrintNonfiscalText|-------------------------------------");
  $err = IF_WRITE("@PrintNonfiscalText|EGRESO DE CAJA No. 80");
  $err = IF_WRITE("@PrintNonfiscalText|Cajero(a): 001 Pedro Perez");
  $err = IF_WRITE("@PrintNonfiscalText|-------------------------------------");
  $err = IF_WRITE("@PrintNonfiscalText|ENTREGADO A:");
  $err = IF_WRITE("@PrintNonfiscalText|Juan Perez");
  $err = IF_WRITE("@PrintNonfiscalText|TOTAL EGRESO Bs. 1.00");
  $err = IF_WRITE("@PrintNonfiscalText|-------------------------------------");
  $err = IF_WRITE("@PrintNonfiscalText|");
  $err = IF_WRITE("@PrintNonfiscalText|");
  $err = IF_WRITE("@PrintNonfiscalText|");
  $err = IF_WRITE("@PrintNonfiscalText|-----------------");
  $err = IF_WRITE("@PrintNonfiscalText|(Recibi conforme)");
  $err = IF_WRITE("@CloseNonfiscalReceipt");

  $err = IF_CLOSE();

?>
