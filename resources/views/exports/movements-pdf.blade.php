<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Movimentações</title>
    <style>
        body { 
            font-family: sans-serif; 
            font-size: 12px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            table-layout: fixed; 
        }
        th { 
            color: white; 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
            font-weight: bold;
            background-color: #0D47A1; 
        }
        td { 
            color: black; 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
            font-weight: bold;
            word-wrap: break-word; 
            overflow-wrap: break-word; 
            word-break: break-word; 
        }
        
        
        th:nth-child(1), td:nth-child(1) { width: 15%; } 
        th:nth-child(2), td:nth-child(2) { width: 10%; } 
        th:nth-child(3), td:nth-child(3) { width: 15%; } 
        th:nth-child(4), td:nth-child(4) { width: 20%; } 
        th:nth-child(5), td:nth-child(5) { 
            width: 40%; 
            max-width: 40%;
        }
        
        .descricao-cell {
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-all;
            white-space: normal; 
        }
    </style>
</head>
<body>
    <h2>Movimentações</h2>
    <table>
        <thead>
            <tr>
                <th>VALOR</th>
                <th>TIPO</th>
                <th>DATA</th>
                <th>CATEGORIA</th>
                <th>DESCRIÇÃO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $movement)
                <tr>
                    <td>R$ {{ number_format($movement->value, 2, ',', '.') }}</td>
                    <td>{{ $movement->type === 'out' ? 'Saída' : 'Entrada' }}</td>
                    <td>{{ $movement->date ? \Carbon\Carbon::parse($movement->date)->format('d/m/Y') : '' }}</td>
                    <td>{{ $movement->category?->name ?? 'Sem categoria' }}</td>
                    <td class="descricao-cell">{{ $movement->description ?? 'Sem descrição' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>