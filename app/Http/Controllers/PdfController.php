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
        $info = '<table style="font-size: 11pt;">
                            <tr>
                                <td style="text-align: right;padding: 4px 10px;">Paciente: </td>
                                <td style="padding: 4px 0px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;padding: 4px 10px;">Dirección: </td>
                                <td style="padding: 4px 0px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;padding: 4px 10px;">Doctor: </td>
                                <td style="padding: 4px 0px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;padding: 4px 10px;">Diagnóstico: </td>
                                <td style="padding: 4px 0px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;padding: 4px 10px;">Habitación: </td>
                                <td style="padding: 4px 0px;"></td>
                            </tr>
                        </table>';
        $mpdf->WriteFixedPosHTML($info, 65, 25, 99, 20);
        // $data = [
        //     'orders' => $orders,
        //     'sale' => $sale
        // ];
        // $view = view('formats.receipt', $data);
        $mpdf->Ln(10);
        $mpdf->WriteHTML('<h3>Lista de insumos</h3>');
        // $payment_info = '<table style="font-size: 14pt;">
        //                     <tr>
        //                         <td style="text-align: right;padding: 4px 10px;">Subtotal:</td>
        //                         <td style="padding: 4px 0px;"><u>$ '.$sale->subtotal.'</u></td>
        //                     </tr>
        //                     <tr>
        //                         <td style="text-align: right;padding: 4px 10px;">Descuento:</td>
        //                         <td style="padding: 4px 0px;"><u>'.$sale->discount.'%</u></td>
        //                     </tr>
        //                     <tr>
        //                         <td style="text-align: right;padding: 4px 10px;">Total:</td>
        //                         <td style="padding: 4px 0px;"><u>$ '.$sale->total.'</u></td>
        //                     </tr>
        //                     <tr>
        //                         <td style="text-align: right;padding: 4px 10px;">Método de pago:</td>
        //                         <td style="padding: 4px 0px;"><u>'.$payment_name->name.'</u></td>
        //                     </tr>
        //                 </table>';
        // $mpdf->WriteFixedPosHTML($payment_info, 98, 235, 100, 20);
        $mpdf->AddPage();
        $mpdf->Output('Insumos.pdf', Destination::INLINE);
    }
}
