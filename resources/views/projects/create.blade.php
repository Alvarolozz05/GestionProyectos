<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Crear proyecto</title>
</head>
<body>
    <h1>Crear proyecto</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" name="title" id="title">
        
        <br><br>
        
        <label for="description">Descripción:</label>
        <textarea name="description" id="description"></textarea>
        
        <br><br>
        
        <label for="due_date">Fecha límite:</label>
        <input type="date" name="due_date" id="due_date">
        
        <br><br>
        
        <label for="status">Estado:</label>
        <select name="status" id="status">
            <option value="Pendiente">Pendiente</option>
            <option value="En progreso">En progreso</option>
            <option value="Completado">Completado</option>
        </select>
        
        <br><br>
        
        <button type="submit">Guardar proyecto</button>
    </form>
    
    <br>
    
    <a href="{{ route('projects.index') }}">Volver al listado</a>
</body>
</html> 