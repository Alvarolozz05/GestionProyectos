<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Detalles del proyecto</title>
</head>
<body>
    <h1>{{ $project->title }}</h1>

    <p>{{ $project->description }}</p>
    <p>Fecha límite: {{ $project->due_date }}</p>
    <p>Estado: {{ $project->status }}</p>

    <hr>

    <h2>Añadir participante</h2>

    <form action="{{ route('projects.participants.store', $project->id) }}" method="POST">
        @csrf
        <label for="user_id">Usuario:</label>
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <br><br>

        <label for="role">Rol:</label>
        <input type="text" name="role" id="role">

        <br><br>

        <label for="contribution_hours">Horas de contribución:</label>
        <input type="number" name="contribution_hours" id="contribution_hours" step="0.1">

        <br><br>

        <button type="submit">Añadir participante</button>
    </form>

    <hr>

    <h2>Participantes del proyecto</h2>
    @foreach ($project->participants as $participant)
        <div>
            <h3>{{ $participant->name }}</h3>
            <p>Rol: {{ $participant->pivot->role }}</p>
            <p>Horas: {{ $participant->pivot->contribution_hours }}</p>
            <h4>Modificar participante</h4>
            <form action="{{ route('projects.participants.update', [$project->id, $participant->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <label>Rol:</label>
                <input type="text" name="role" value="{{ $participant->pivot->role }}">

                <br><br>

                <label>Horas de contribución:</label>
                <input type="number" name="contribution_hours" step="0.1" value="{{ $participant->pivot->contribution_hours }}">

                <br><br>

                <button type="submit">Actualizar participante</button>
                <form action="{{ route('projects.participants.destroy', [$project->id, $participant->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Eliminar participante</button>
                </form>
            </form>
        </div>
        <hr>
    @endforeach
    <a href="{{ route('projects.index') }}">Volver al listado</a>
</body>
</html>