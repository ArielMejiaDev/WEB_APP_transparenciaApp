<?php

function imprimirDatos(){
    $datos = '';
    $conexion = new PDO("mysql:host=localhost;dbname=transparencia_app","root","");
    $sql = "SELECT * FROM documentos";
    $stmt=$conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($resultado);
    foreach ($resultado as $key => $value) {
        $datos.='   <tr>  
                      <td>'.utf8_encode($value["id_usuario"]).'</td>  
                      <td>'.utf8_encode($value["id_numeral"]).'</td>  
                      <td>'.utf8_encode($value["id_categoria"]).'</td> 
                      <td>'.utf8_encode($value["n_doc"]).'</td>  
                      <td>'.date("d-m-Y", strtotime($value["fecha_publicacion"])).'</td>
                      <td>'.date("d-m-Y", strtotime($value["fecha_doc"])).'</td>
                      <td>'.$value["status"].'</td>
                    </tr>';
    }
    return $datos;
}

//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo PARA CAMBIARLO IR AL FOLDER EXAMPLES Y AL FOLDER
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $image_file = K_PATH_IMAGES.'logo blanco y negro transparente.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        $this->SetY(5);
        // Title
        $this->Cell(0, 15, 'Instituto de Previsión Militar', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        // Set font
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(0, 0, 'Tel: 0000-0000', 0, 1, 'C');
        $this->Cell(0, 0, 'dar para recibir', 0, 1, 'C');
        $this->Cell(0, 0, 'coso', 0, 1, 'C');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pag '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ariel Salvador');
$pdf->SetTitle('Informe');
$pdf->SetSubject('Informe');
$pdf->SetKeywords('Informe');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage('L');

$content = '';  
        $content .= '  
        <h3 align="center">Informe de documentos </h3><br /><br />  
        <table class="table table-hover invoice" border="1" cellspacing="0" cellpadding="5">  
           <thead> 
                <tr bgcolor="#eee">
                    <th>Usuario</th> 
                    <th>Numeral</th> 
                    <th>Categoria</th>
                    <th># Doc</th> 
                    <th>Fecha Publicación</th>
                    <th>Fecha del Documento</th>                
                    <th>Status</th>
                </tr> 
            </thead> 
        ';  
        $content .= imprimirDatos();  
        $content .= '</table>';  
        $pdf->writeHTML($content);  
        $pdf->Output('tabla sencilla.pdf', 'I'); 

// print a block of text using Write()
//$pdf->Write(0, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('carta_u_oficio.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+