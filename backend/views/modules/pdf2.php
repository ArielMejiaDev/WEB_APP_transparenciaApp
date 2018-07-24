<?php
require_once('../../views/lib/tcpdf/tcpdf.php');
class MYPDF extends TCPDF {
    public function Header() {
        // Logo PARA CAMBIARLO IR AL FOLDER EXAMPLES Y AL FOLDER
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $image_file = K_PATH_IMAGES.'logo blanco y negro transparente.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< Encabezado >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Pag '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ariel Salvador');
$pdf->SetTitle('Informe de documentos S.I.T.');
$pdf->SetSubject('Informe de documentos S.I.T.');
$pdf->SetKeywords('Informe de documentos S.I.T.');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage();
$content = '';  
$content .= '  
<h3 align="center">Tabla sencilla en html a PDF con TCPDF.</h3><br /><br />  
<table class="table table-hover invoice" border="1" cellspacing="0" cellpadding="5">  
    <thead> 
        <tr bgcolor="#eee"> 
            <th>#</th> 
            <th>Nombres</th> 
            <th>Apellidos</th> 
            <th>Usuario</th>
            <th>email</th> 
            <th>rol</th>                
        </tr> 
    </thead>';   
$content .= '</table>';  
$pdf->writeHTML($content);  
$pdf->Output('Informe Documentos SIT.pdf', 'I'); 
?>