<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Receita - {{ $revenue->name }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #222;
            margin: 20px;
            background-color: #f7f7f7;
        }

        h1, h2 {
            color: #d35400; /* Laranja queimado */
            margin-bottom: 5px;
        }

        .section-title {
            background-color: #d35400; /* Laranja forte */
            color: white;
            padding: 6px 10px;
            font-weight: bold;
            margin-top: 20px;
            border-radius: 4px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border-radius: 4px;
            overflow: hidden;
        }

        .info-table th, .info-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }

        .info-table th {
            background-color: #e6e6e6;
            color: #333;
            width: 25%;
            font-weight: bold;
        }

        .info-table td {
            color: #444;
        }

        .ingredients-list {
            list-style-type: disc;
            padding-left: 20px;
            margin-top: 8px;
            color: #333;
        }

        .ingredients-list li {
            margin-bottom: 4px;
        }

        .preparation {
            margin-top: 10px;
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            white-space: pre-line;
            text-align: justify;
            color: #333;
        }

        .image-container {
            text-align: center;
            margin-top: 10px;
        }

        .image-container img {
            max-width: 300px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #d35400;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>
<body>

    <h1>{{ $revenue->name }}</h1>

    @if($revenue->image?->url)
        <div class="image-container">
            <img src="{{ public_path('' . $revenue->image->url) }}" alt="Imagem da receita">
        </div>
    @endif

    <div class="section-title">Informações</div>
    <table class="info-table">
        <tr>
            <th>Categoria</th>
            <td>{{ $revenue->category?->name ?? 'Sem categoria' }}</td>
        </tr>
        <tr>
            <th>Dificuldade</th>
            <td>{{ ucfirst($revenue->difficulty) }}</td>
        </tr>
        <tr>
            <th>Tempo de preparo</th>
            <td>{{ $revenue->time }} minutos</td>
        </tr>
        <tr>
            <th>Porções</th>
            <td>{{ $revenue->portions }}</td>
        </tr>
    </table>

    <div class="section-title">Ingredientes</div>
    <ul class="ingredients-list">
        @forelse($revenue->ingredients ?? [] as $ingredient)
            <li>{{ $ingredient->name }}</li>
        @empty
            <li>Sem ingredientes cadastrados.</li>
        @endforelse
    </ul>

    <div class="section-title">Modo de preparo</div>
    <div class="preparation">
        {!! nl2br(e($revenue->preparation_method)) !!}
    </div>

    <footer>
        <p>Gerado em {{ now()->format('d/m/Y H:i') }}</p>
    </footer>
</body>
</html>
