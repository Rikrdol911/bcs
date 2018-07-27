<?php

// Este modulo contiene el código a disposicion por parte de IFDRIVERS
// en una base TAL CUAL. Todo receptor del Modulo se considera
// bajo licencia de los derechos de autor de IFDRIVERS para utilizar el
// codigo fuente siempre en modo que el o ella considere conveniente,
// incluida la copia, la compilacion, su modificacion o la redistribucion,
// con o sin modificaciones. Ninguna licencia o patentes de IFDRivers
// este implicita en la presente licencia.
//
// El usuario del codigo fuente debera entender que IFDRIVERS no puede
// Proporcionar apoyo tecnico para el modulo y no sera Responsable
// de las consecuencias del uso del programa.
//
// Todas las comunicaciones, incluida esta, no deben ser removidos
// del modulo sin el consentimiento previo por escrito de IFDRIVERS
// www: http://www.impresoras-fiscales.com.ar/
// email: soporte@impresoras-fiscales.com.ar
//
// Instrucciones para usar el driver y las funciones de alto nivel en PHP:
//
// 1) Instale la extension fiscal en el directorio ext de PHP.
// 2) Agregue la extension fiscal en el archivo php.ini, por ejemplo
//
// Para versiones de PHP Thread Safe ( la mas usada)
// extension = php_TM20V5xts.dll 
//
// Para versiones de PHP Non-Thread Safe (la menos usada)
// extension = php_TM20V5xnts.dll 
//
// 3) Copie el archivo con estas funciones al directorio de su su proyecto.
// 4) Agregue las funciones con la funcion required al principio del codigo php
// 5) Todas las funciones de la extension fiscal mas las funciones de alto nivel
//    seran accesibles desde PHP.
// 
// Por ejemplo:
//
// require_once 'TM20PhpApi.php'
//
// $objEpsonVE = new EpsonVE();
//
// $nError = $objEpsonVE->IF_OPEN("COM1",9600);
//
// ....etc
//
// $nError = $objEpsonVE->IF_ERROR1(0);
//
// $nError = $objEpsonVE->IF_ERROR2(0);
//
// $nError = $objEpsonVE->IF_CLOSE();
//

class EpsonVE 
{

    FUNCTION IF_OPEN($strPort, $nSpeed)
    {
		$nError = IF_OPEN($strPort, $nSpeed);
		
		return $nError;
    }
    
    FUNCTION IF_CLOSE()
    {
		$nError = IF_CLOSE();
		
		return $nError;
    }
    
    FUNCTION IF_READ($nField)
    {
		$strVal = IF_READ($nField);
		
		return $strVal;
    }
    
    FUNCTION IF_WRITE($strCommand)
    {
		$nError = IF_WRITE($strCommand);
		
		return $nError;
    }
    
    FUNCTION IF_ERROR1($nBit)
    {
		$nError = IF_ERROR1($nBit);
		
		return $nError;
    }
    
    FUNCTION IF_ERROR2($nBit)
    {
		$nError = IF_ERROR2($nBit);
		
		return $nError;
    }
    
    FUNCTION IF_TRACE($nTrace)
    {
		IF_TRACE($nTrace);
		
		return;
    }
    
    FUNCTION IF_SETLOG($strFile)
    {
		IF_SETLOG($strFile);
		
		return;
    }
    
    //*******************************************************************************
    //* 1. Comandos de Control Fiscal
    //*******************************************************************************
    // StatusRequest()
    // 
    // Syntax: 
    //		$objFiscal->StatusRequest($byVar1);
    // Propósito:
    //		Consulta de estado
    // Argumentos: 
    //		byVar1	Tipo de información solicitada {NEABCDRFJSU}
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION StatusRequest($byVar1)
    {
     $nError = 0; 		

     $strBuff= "@StatusRequest" . "|" . $byVar1;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // DailyClose()
    // 
    // Syntax: 
    //		$objFiscal->DailyClose($byVar1, $byVar2);
    // Propósito:
    //		Cierre de jornada fiscal
    // Argumentos: 
    //		byVar1	Tipo de reporte {ZX}
    //		byVar2	parametro de impresion
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION DailyClose($byVar1, $byVar2)
    {
     $nError = 0; 		

     $strBuff= "@DailyClose" . "|" . $byVar1 . "|" . $byVar2;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // DailyCloseByDate()
    // 
    // Syntax: 
    //		$objFiscal->DailyCloseByDate($strVar1, $strVar2, $byVar3);
    // Propósito:
    //		Reporte de auditoria por fechas
    // Argumentos: 
    //		strVar1	Fecha de inicio de selección AAMMDD (max 6 bytes)
    //		strVar2	Fecha de fin de selección AAMMDD (max 6 bytes)
    //		byVar3	Calificador de reporte {DMRC}
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION DailyCloseByDate($strVar1, $strVar2, $byVar3)
    {
     $nError = 0; 		

     $strBuff= "@DailyCloseByDate" . "|" . $strVar1 . "|" . $strVar2 . "|" . $byVar3;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // DailyCloseByNumber()
    // 
    // Syntax: 
    //		$objFiscal->DailyCloseByNumber($nVar1, $nVar2, $byVar3);
    // Propósito:
    //		Reporte de auditoria por numero
    // Argumentos: 
    //		nVar1	Número de Z de inicio de selección (nnnn)
    //		nVar2	Número de Z de fin de selección (nnnn)
    //		byVar3	Calificador de reporte
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION DailyCloseByNumber($nVar1, $nVar2, $byVar3)
    {
     $nError = 0; 		

     $strBuff= "@DailyCloseByNumber" . "|" . $nVar1 . "|" . $nVar2 . "|" . $byVar3;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    //* 2. Comandos para generar comprobantes fiscales
    //*******************************************************************************
    // OpenFiscalReceipt()
    // 
    // Syntax: 
    //		$objFiscal->OpenFiscalReceipt($strVar1, $strVar2, $strVar3, $strVar4, $strVar5, $strVar6, $byVar7, 
    //		                   $byVar8, $byVar9);
    // Propósito:
    //		Abrir comprobante fiscal
    // Argumentos: 
    //		strVar1	Razón social (max 40 bytes)
    //		strVar2	RIF del comprador (max 20 bytes)
    //		strVar3	Nro de comprobante (en devolución) (max 20 bytes)
    //		strVar4	Serial de la maquina fiscal que realizo el comprobante en devolución (Solo en nota de crédito) (max 20 bytes)
    //		strVar5	Fecha del comprobante en devolución (Solo en nota de crédito) (max 6 bytes)
    //		strVar6	Hora del comprobante en devolución (Solo en nota de crédito) (max 6 bytes)
    //		byVar7	Tipo de documento {TD}
    //		byVar8	Campo reservado
    //		byVar9	Campo reservado
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION OpenFiscalReceipt($strVar1, $strVar2, $strVar3, $strVar4, $strVar5, $strVar6, $byVar7, $byVar8, $byVar9)
    {
     $nError = 0; 		

     $strBuff= "@OpenFiscalReceipt" . "|" . $strVar1 . "|" . $strVar2 . "|" . $strVar3 . "|" . 
             $strVar4 . "|" . $strVar5 . "|" . $strVar6 . "|" . $byVar7 . "|" . 
              $byVar8 . "|" . $byVar9;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // PrintFiscalText()
    // 
    // Syntax: 
    //		$objFiscal->PrintFiscalText($strVar1, $byVar2);
    // Propósito:
    //		Imprimir texto fiscal
    // Argumentos: 
    //		strVar1	Texto Fiscal a Imprimir (max 26 bytes)
    //		byVar2	Calificador de Impresión {SO}
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION PrintFiscalText($strVar1, $byVar2)
    {
     $nError = 0; 		

     $strBuff= "@PrintFiscalText" . "|" . $strVar1 . "|" . $byVar2;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // PrintLineItem()
    // 
    // Syntax: 
    //		$objFiscal->PrintLineItem($strVar1, $dblVar2, $dblVar3, $dblVar4, $byVar5, $byVar6, $byVar7, 
    //		               $byVar8);
    // Propósito:
    //		Imprimir item
    // Argumentos: 
    //		strVar1	Descripción de hasta 20 caracteres (max 20 bytes)
    //		dblVar2	Cantidad (nnnn.nnn)
    //		dblVar3	Monto del ítem (nnnnnnnn.nn)
    //		dblVar4	Tasa impositiva (.nnnn)
    //		byVar5	Calificador de ítem de línea {Mm}
    //		byVar6	Reservado
    //		byVar7	Reservado
    //		byVar8	Reservado
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION PrintLineItem($strVar1, $dblVar2, $dblVar3, $dblVar4, $byVar5, $byVar6, $byVar7, $byVar8)
    {
     $nError = 0; 		

     $strBuff= "@PrintLineItem" . "|" . $strVar1 . "|" . $dblVar2 . "|" . $dblVar3 . "|" . 
             $dblVar4 . "|" . $byVar5 . "|" . $byVar6 . "|" . $byVar7 . "|" . 
              $byVar8;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // Subtotal()
    // 
    // Syntax: 
    //		$objFiscal->Subtotal($byVar1, $byVar2);
    // Propósito:
    //		Subtotal
    // Argumentos: 
    //		byVar1	Reservado
    //		byVar2	Reservado
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION Subtotal($byVar1, $byVar2)
    {
     $nError = 0; 		

     $strBuff= "@Subtotal" . "|" . $byVar1 . "|" . $byVar2;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // ReturnRecharge()
    // 
    // Syntax: 
    //		$objFiscal->ReturnRecharge($strVar1, $dblVar2, $byVar3, $dblVar4);
    // Propósito:
    //		Pago,Cancelar y Descuento en Comprobante fiscal
    // Argumentos: 
    //		strVar1	Descripción de 20 caracteres (max 20 bytes)
    //		dblVar2	Monto de pago (nnnnnn.nn)
    //		byVar3	Calificador de comando {CTDP}
    //		dblVar4	Tasa impositiva sobre la que aplica la promoción (.nnnn)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION ReturnRecharge($strVar1, $dblVar2, $byVar3, $dblVar4)
    {
     $nError = 0; 		

     $strBuff= "@ReturnRecharge" . "|" . $strVar1 . "|" . $dblVar2 . "|" . $byVar3 . "|" . 
             $dblVar4;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // CloseFiscalReceipt()
    // 
    // Syntax: 
    //		$objFiscal->CloseFiscalReceipt($byVar1);
    // Propósito:
    //		Cerrar comprobante fiscal
    // Argumentos: 
    //		byVar1	Calificador de comando {AET}
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION CloseFiscalReceipt($byVar1)
    {
     $nError = 0; 		

     $strBuff= "@CloseFiscalReceipt" . "|" . $byVar1;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    //* 3. Comandos para generar documentos no fiscales
    //*******************************************************************************
    // OpenNonFiscalReceipt()
    // 
    // Syntax: 
    //		$objFiscal->OpenNonFiscalReceipt();
    // Propósito:
    //		Abrir comprobante no-fiscal
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION OpenNonFiscalReceipt()
    {
     $nError = 0; 		

     $strBuff= "@OpenNonFiscalReceipt";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // PrintNonFiscalText()
    // 
    // Syntax: 
    //		$objFiscal->PrintNonFiscalText($strVar1);
    // Propósito:
    //		Imprimir texto no-fiscal
    // Argumentos: 
    //		strVar1	Hasta 40 caracteres de texto fiscal (max 40 bytes)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION PrintNonFiscalText($strVar1)
    {
     $nError = 0; 		

     $strBuff= "@PrintNonFiscalText" . "|" . $strVar1;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // CloseNonFiscalReceipt()
    // 
    // Syntax: 
    //		$objFiscal->CloseNonFiscalReceipt($byVar1);
    // Propósito:
    //		Cerrar comprobante no-fiscal
    // Argumentos: 
    //		byVar1	Calificador de comando {ET}
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION CloseNonFiscalReceipt($byVar1)
    {
     $nError = 0; 		

     $strBuff= "@CloseNonFiscalReceipt" . "|" . $byVar1;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    //* 4. Comandos de control de la impresora
    //*******************************************************************************
    // PaperCut()
    // 
    // Syntax: 
    //		$objFiscal->PaperCut();
    // Propósito:
    //		Cortar papel
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION PaperCut()
    {
     $nError = 0; 		

     $strBuff= "@PaperCut";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // FeedReceipt()
    // 
    // Syntax: 
    //		$objFiscal->FeedReceipt();
    // Propósito:
    //		Avanzar papel de tickets
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION FeedReceipt()
    {
     $nError = 0; 		

     $strBuff= "@FeedReceipt";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // ActivateSlip()
    // 
    // Syntax: 
    //		$objFiscal->ActivateSlip();
    // Propósito:
    //		Activar Split
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION ActivateSlip()
    {
     $nError = 0; 		

     $strBuff= "@ActivateSlip";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // InActivateSlip()
    // 
    // Syntax: 
    //		$objFiscal->InActivateSlip();
    // Propósito:
    //		Este comando desactiva el funcionamiento del Slip.
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION InActivateSlip()
    {
     $nError = 0; 		

     $strBuff= "@InActivateSlip";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // FormatoCheque()
    // 
    // Syntax: 
    //		$objFiscal->FormatoCheque($strVar1, $strVar2, $strVar3, $byVar4, $byVar5, $byVar6, $byVar7, $byVar8);
    // Propósito:
    //		Este comando imprime por el Slip en el formato de un cheque.
    // Argumentos: 
    //		strVar1	Monto del Cheque (max 12 bytes)
    //		strVar2	Beneficiario (max 40 bytes)
    //		strVar3	Fecha de emisión (max 20 bytes)
    //		byVar4	'E' = Se imprime la frase 'NO ENDOSABLE', 'R' = Se imprime la frase 'NO ENDOSABLE' en negrita {ER}
    //		byVar5	Separacion entre lineas monto y benficiario(1 al 7)
    //		byVar6	Separacion entre 'la cantidad' y la fecha(1 al 7)
    //		byVar7	Separacion entre 'no endosable' y el monto superior(1 al 7)
    //		byVar8	Separacion entre 'beneficiario' y la cantidad ( 1 al 7)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION FormatoCheque($strVar1, $strVar2, $strVar3, $byVar4, $byVar5, $byVar6, $byVar7, $byVar8)
    {
     $nError = 0; 		

     $strBuff= "@FormatoCheque" . "|" . $strVar1 . "|" . $strVar2 . "|" . $strVar3 . "|" . 
             $byVar4 . "|" . $byVar5 . "|" . $byVar6 . "|" . $byVar7 . "|" . 
              $byVar8;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // FormatoEndoso()
    // 
    // Syntax: 
    //		$objFiscal->FormatoEndoso($strVar1, $strVar2, $strVar3, $byVar4);
    // Propósito:
    //		Este comando imprime por el Slip el endoso para un cheque.
    // Argumentos: 
    //		strVar1	Texto a imprimir (max 33 bytes)
    //		strVar2	Texto a imprimir (max 40 bytes)
    //		strVar3	Texto a Imprimir (max 40 bytes)
    //		byVar4	 {ABC}
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION FormatoEndoso($strVar1, $strVar2, $strVar3, $byVar4)
    {
     $nError = 0; 		

     $strBuff= "@FormatoEndoso" . "|" . $strVar1 . "|" . $strVar2 . "|" . $strVar3 . "|" . 
             $byVar4;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    //* 5. Comandos generales
    //*******************************************************************************
    // SetDateTime()
    // 
    // Syntax: 
    //		$objFiscal->SetDateTime($strVar1, $strVar2);
    // Propósito:
    //		Ingresar fecha y hora 
    // Argumentos: 
    //		strVar1	Formato de Fecha AAMMDD (Año, Mes, Día) (max 6 bytes)
    //		strVar2	Formato de Hora HHMMSS (Hora, Minutos, Segundos) (max 6 bytes)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION SetDateTime($strVar1, $strVar2)
    {
     $nError = 0; 		

     $strBuff= "@SetDateTime" . "|" . $strVar1 . "|" . $strVar2;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // GetDateTime()
    // 
    // Syntax: 
    //		$objFiscal->GetDateTime();
    // Propósito:
    //		Consultar fecha y hora
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION GetDateTime()
    {
     $nError = 0; 		

     $strBuff= "@GetDateTime";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // SetHeader()
    // 
    // Syntax: 
    //		$objFiscal->SetHeader($nVar1, $strVar2);
    // Propósito:
    //		Programar texto de encabezamiento 
    // Argumentos: 
    //		nVar1	Número de línea de datos fijos (nn)
    //		strVar2	Texto Fiscal de hasta 40 caracteres (max 40 bytes)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION SetHeader($nVar1, $strVar2)
    {
     $nError = 0; 		

     $strBuff= "@SetHeader" . "|" . $nVar1 . "|" . $strVar2;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // SetTrailer()
    // 
    // Syntax: 
    //		$objFiscal->SetTrailer($nVar1, $strVar2);
    // Propósito:
    //		Programar texto de cola
    // Argumentos: 
    //		nVar1	Número de línea de datos fijos (nn)
    //		strVar2	Texto Fiscal de hasta 40 caracteres (max 40 bytes)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION SetTrailer($nVar1, $strVar2)
    {
     $nError = 0; 		

     $strBuff= "@SetTrailer" . "|" . $nVar1 . "|" . $strVar2;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // OpenDrawer1()
    // 
    // Syntax: 
    //		$objFiscal->OpenDrawer1();
    // Propósito:
    //		Abrir gaveta de dinero 1
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION OpenDrawer1()
    {
     $nError = 0; 		

     $strBuff= "@OpenDrawer1";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // OpenDrawer2()
    // 
    // Syntax: 
    //		$objFiscal->OpenDrawer2();
    // Propósito:
    //		Abrir gaveta de dinero 2
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION OpenDrawer2()
    {
     $nError = 0; 		

     $strBuff= "@OpenDrawer2";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // SerialRequest()
    // 
    // Syntax: 
    //		$objFiscal->SerialRequest();
    // Propósito:
    //		Obtener el Nro de serie de la impresora
    // Argumentos: 
    //		Ninguno
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION SerialRequest()
    {
     $nError = 0; 		

     $strBuff= "@SerialRequest";	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
    //*******************************************************************************
    // ProgramTaxes()
    // 
    // Syntax: 
    //		$objFiscal->ProgramTaxes($dblVar1, $dblVar2, $dblVar3);
    // Propósito:
    //		Obtener el Nro de serie de la impresora
    // Argumentos: 
    //		dblVar1	Tasa Standard (.nnnn)
    //		dblVar2	Tasa IVA 2 (.nnnn)
    //		dblVar3	Tasa IVA 3 (.nnnn)
    // Devuelve:
    //		0 si no hay error y != 0 si hay un error
    //******************************************************************************
    FUNCTION ProgramTaxes($dblVar1, $dblVar2, $dblVar3)
    {
     $nError = 0; 		

     $strBuff= "@ProgramTaxes" . "|" . $dblVar1 . "|" . $dblVar2 . "|" . $dblVar3;	

     $nError = IF_WRITE($strBuff);
 
     return ($nError);
    }
 
}
?>
