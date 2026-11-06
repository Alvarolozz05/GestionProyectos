<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del proyecto</title>
</head>
<body>
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>
    <p>Fecha límite: {{ $project->due_date }}</p>
    <p>Estado: {{ $project->status }}</p>
    <a href="{{ route('projects.index') }}">Volver al listado</a>
</body>
</html>