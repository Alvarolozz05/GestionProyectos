<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Listado de proyectos</title>
</head>
<body>
    <h1>Listado de proyectos</h1>

    @if (session('error'))
        <p style="color: red;">
            {{ session('error') }}
        </p>
    @endif

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('projects.create') }}">Crear proyecto</a>

    @foreach ($projects as $project)
        <div>
            <h2>{{ $project->title }}</h2>
            <p>{{ $project->description }}</p>
            <p>Fecha límite: {{ $project->due_date }}</p>
            <p>Estado: {{ $project->status }}</p>

            <a href="{{ route('projects.show', $project->id) }}">Ver proyecto</a>
            <a href="{{ route('projects.edit', $project->id) }}">Editar proyecto</a>

            <br><br>
            
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar proyecto</button>
            </form>
        </div>
        <hr>
    @endforeach
</body>
</html>