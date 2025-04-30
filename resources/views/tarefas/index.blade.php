<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
</head>
<body>
<h1>Tarefas</h1>
    <ul>
        @foreach($tarefas as $tarefa)
            <li>{{ $tarefa->titulo }}</li>
        @endforeach
    </ul>
</body>
</html>