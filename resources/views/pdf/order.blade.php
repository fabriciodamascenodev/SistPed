<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedido #{{ $order->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header-table {
            width: 100%;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .company-info h1 {
            margin: 0;
            font-size: 20px;
            color: #2d3748;
        }
        .client-box {
            width: 100%;
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #2d3748;
            color: white;
            padding: 8px;
            text-align: left;
        }
        .items-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .total-box {
            width: 100%;
            text-align: right;
        }
        .total-label { font-weight: bold; font-size: 14px; }
        .total-value { font-weight: bold; font-size: 18px; color: #2d3748; }
        
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="company-info">
                <h1>SistPed</h1>
                <p>Soluções em Descartáveis</p>
            </td>
            <td class="text-right">
                <strong>Pedido Nº:</strong> {{ $order->id }}<br>
                <strong>Data:</strong> {{ $order->created_at->format('d/m/Y H:i') }}<br>
                <strong>Status:</strong> {{ ucfirst($order->status) }}
            </td>
        </tr>
    </table>

    <div class="client-box">
        <h3>Dados do Cliente</h3>
        <table style="width: 100%">
            <tr>
                <td><strong>Nome:</strong> {{ $client->name }}</td>
                <td><strong>Telefone:</strong> {{ $client->phone }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Endereço:</strong> 
                    {{ $client->street }}, {{ $client->number }} 
                    @if($client->complement) - {{ $client->complement }} @endif
                    - {{ $client->district }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    {{ $client->city }}/{{ $client->state }} - CEP: {{ $client->cep }}
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%">Produto</th>
                <th class="text-center" style="width: 15%">Qtd</th>
                <th class="text-right" style="width: 15%">Unitário</th>
                <th class="text-right" style="width: 20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">R$ {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                <td class="text-right">R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <table style="width: 40%; float: right;">
            <tr>
                <td class="text-right">Forma de Pagamento:</td>
                <td class="text-right"><strong>{{ $order->payment_method == 'cash' ? 'À Vista' : 'Faturado' }}</strong></td>
            </tr>
            <tr>
                <td class="text-right total-label">Total Geral:</td>
                <td class="text-right total-value">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Documento gerado eletronicamente pelo SistPed.
    </div>

</body>
</html>