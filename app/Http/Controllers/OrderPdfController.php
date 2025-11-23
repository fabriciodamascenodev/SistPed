<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Mpdf\Mpdf;

class OrderPdfController extends Controller
{
    public function download(Order $record)
    {
        // Carrega as relações
        $record->load(['client', 'items.product']);

        // Dados para a view
        $data = [
            'order' => $record,
            'client' => $record->client,
            'items' => $record->items
        ];

        // Renderiza a view
        $html = view('pdf.order', $data)->render();

        // Cria o PDF
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 20,
            'margin_bottom' => 20,
            'margin_left' => 15,
            'margin_right' => 15,
        ]);

        $mpdf->WriteHTML($html);

        // Exibe no navegador
        return response($mpdf->Output("Pedido-{$record->id}.pdf", 'I'))
            ->header('Content-Type', 'application/pdf');
    }
}