<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Editar proyecto</title>
</head>
<body>
    <h1>Editar proyecto</h1>
    
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ $project->title }}">
        
        <br><br>
        
        <label for="description">Descripción:</label>
        <textarea name="description" id="description">{{ $project->description }}</textarea>
        
        <br><br>
        
        <label for="due_date">Fecha límite:</label>
        <input type="date" name="due_date" id="due_date" value="{{ $project->due_date ? $project->due_date->format('Y-m-d') : '' }}">
        
        <br><br>
        
        <label for="status">Estado:</label>
        <select name="status" id="status">
            <option value="Pendiente" {{ $project->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="En progreso" {{ $project->status == 'En progreso' ? 'selected' : '' }}>En progreso</option>
            <option value="Completado" {{ $project->status == 'Completado' ? 'selected' : '' }}>Completado</option>
        </select>
        
        <br><br>
        
        <button type="submit">Guardar cambios</button>
    </form>
    
    <br>
    
    <a href="{{ route('projects.index') }}">Volver al listado</a>
</body>
</html>