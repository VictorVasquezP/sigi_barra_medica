<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Mpdf\PdfFormat;
use Mpdf\Output\Destination;

class PdfController extends Controller
{
    public function commandPdf($id){
        $command = Command::find($id);

        $insumos = $command->insumos;

        $mpdf = new PdfFormat();
        $mpdf->charset_in = 'utf-8';
        $mpdf->title = 'EL PALENQUE';
        $mpdf->description = 'DEPOT';
        $data = [
            'command' => $command,
            'insumos'=>$insumos
        ];
        $view = view('pdf.insumos', $data);
        $mpdf->WriteHTML($view);
        $mpdf->Output('Insumos.pdf', Destination::INLINE);
    }
}
