<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar un plazo</title>
</head>
<body>
<h1>Agregar un plazo</h1>

<form action="/plazo/form/añadir" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    
    <label for="input_string">Cadena de texto:</label>
    <input type="text" id="input_string" name="input_string" placeholder="Lorem impus. . ." required>
    <br/>

    <label for="interval">Longitud del plazo:</label>
    <select id="interval" name="interval" required>
        <option value="weekly">Semanal</option>
        <option value="monthly">Mensual</option>
        <option value="quarterly">Trimestral</option>
    </select>
    <br/>

    <button type="submit">Agregar plazo</button>
</form>
</body>
</html>
