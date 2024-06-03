<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Livros por Autor</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Relatório de Livros por Autor</h1>
    <table>
        <thead>
            <tr>
                <th>Autor</th>
                <th>Livro</th>
                <th>Editora</th>
                <th>Preço</th>
                <th>Ano de Publicação</th>
                <th>Assunto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $dado)
                <tr>
                    <td>{{ $dado->autor }}</td>
                    <td>{{ $dado->livro }}</td>
                    <td>{{ $dado->editora }}</td>
                    <td>{{ $dado->preco }}</td>
                    <td>{{ $dado->ano_publicacao }}</td>
                    <td>{{ $dado->assunto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>