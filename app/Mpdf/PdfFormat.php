<?php
namespace App\Mpdf;

class PdfFormat extends \Mpdf\Mpdf
{
    var $title, $description, $x;
    function __construct(array $config = [])
    {
        $x = '{nb}';
        //Call parent constructor
        parent::__construct($config);
    }
    // Cabecera de página
    function Header($content = '')
    {
        // Images
        //Linea Top
        // $this->SetLineWidth(8);
        // $this->SetDrawColor(52, 52, 52 );
        // $this->Line(0,3.5,210,3.5);
        //Linea Left
        $this->SetLineWidth(3);
        $this->SetDrawColor(44, 212, 196 ); //1, 35, 80
        $this->Line(8,10,8,288);
        // //logo ($file, $x, $y, $w = 0, $h = 0)
        $this->Image('letterhead/logo.jpg',17,10,50,20);

        $this->Image('letterhead/logo.png',41,90, 128, 160);
        //Legenda superior
        // $this->SetTextColor(44, 212, 196);
        // $this->SetFont('DejaVuSansMono','',20); //DejaVuSansMono, FreeMono, XBRiyaz, Aegean, Aegyptus
        // $txt = iconv('utf-8', 'cp1252', $this->title);
        // $this->WriteText(15,58,utf8_encode($txt));

        $this->SetTextColor(44, 212, 196 );
        $this->SetFont('DejaVuSansMono','B',20); //DejaVuSansMono, FreeMono, XBRiyaz, Aegean, Aegyptus
        $txt = iconv('utf-8', 'cp1252', 'GASTOS MÉDICOS');
        $this->WriteText(90,20,utf8_encode($txt));
        $this->SetY(38); //de donde va a comenzar el contenido
    }

    // Pie de página
    function Footer()
    {
        $this->SetLineWidth(10);
        $this->SetDrawColor(44, 212, 196);
        $this->Line(0,292,210,292);
        // Arial italic 8
        $this->SetFont('Arial','',10);
        // Posición: a 1,5 cm del final
        $this->SetY(-11);
        $this->SetTextColor(0,0,0);
        // Número de página                                   C= Center, L= Left, R = Right
        $this->Cell(0,11,'BARRA MEDICA CENTER',0,0,'C');
        $this->Cell(0,11,'Página '.$this->PageNo().'/{nb}',0,0,'R');
        
    }
}

?>