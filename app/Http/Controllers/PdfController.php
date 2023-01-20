<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Mpdf\PdfFormat;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;

class PdfController extends Controller
{
    public function commandPdf($id){
        $command = Command::find($id);
        $command->created_at = date('d/m/Y h:i a',strtotime($command->created_at));

        $mpdf = new PdfFormat();
        $mpdf->charset_in = 'utf-8';
        $mpdf->title = 'EL PALENQUE';
        $mpdf->description = 'DEPOT';
        $data = [
            'command' => $command
        ];
        $view = view('pdf.insumos', $data);
        $mpdf->WriteHTML($view);
        $mpdf->Output('Insumos.pdf', Destination::INLINE);
    }
}
