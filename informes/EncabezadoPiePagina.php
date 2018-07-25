<?php
require_once('tcpdf/tcpdf.php');
// EXTENDIENDDO LA CLASE TCPDF PARA EL HEADER Y FOOTER
class MYPDF extends TCPDF 
{
    // HEADER
    public function Header()
    {
        // Logo PARA CAMBIARLO IR AL FOLDER EXAMPLE
        $image_file = K_PATH_IMAGES.'logo blanco y negro transparente.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 20);
        $this->SetY(7);
        $this->Cell(0, 8, 'Instituto de Previsión Militar', 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(0, 0, 'www.ipm.org.gt', 0, 1, 'C');
        $this->Cell(0, 0, 'PBX: 2305-4900', 0, 1, 'C');
        $this->Cell(0, 0, 'GUATEMALA - REPÚBLICA DE GUATEMALA, C.A. ', 0, 1, 'C');
    }
    // FOOTER
    public function Footer()
    {    
        $informe = new InformesController();
        $usuario = $informe->getUserController();
        // POCISIONANDO 15 ANTES DEL FINAL DE LA PAGINA
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        // FUNCTION PARA IMPRIMIR NUMERO DE PAGINA.
        $this->Cell(0, 10, 'Pag '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() . ' Generado por: '.$usuario.' ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}