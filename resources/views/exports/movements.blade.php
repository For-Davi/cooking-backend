<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Movimentações</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Movimentações</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
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
                    <td>{{ $movement->id }}</td>
                    <td>{{ number_format($movement->value, 2, ',', '.') }}</td>
                    <td>{{ $movement->type === 'out' ? 'Saída' : 'Entrada' }}</td>
                    <td>{{ $movement->date ? \Carbon\Carbon::parse($movement->date)->format('d-m-Y') : '' }}</td>
                    <td>{{ $movement->category?->name ?? 'Sem categoria' }}</td>
                    <td>{{ $movement->description ?? 'Sem descrição' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
