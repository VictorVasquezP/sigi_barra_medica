<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\ProductCommand;
use App\Mpdf\PdfFormat;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;

class PdfController extends Controller
{
    public function commandPdf($id){
        $command = Command::find($id);

        $insumos = ProductCommand::join('products', 'products.id', '=', 'product_commands.product_id')
            ->select('product_commands.product_id as id', 'product_commands.price', 'product_commands.quantity', 'product_commands.total', 'products.name', 'products.description')
            ->where('product_commands.command_id', '=', $id)
            ->get();

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
