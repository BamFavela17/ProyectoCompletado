<!DOCTYPE html>
<html>
<body>
<h1>Formulario Texto</h1>
@if(session('texto'))
    <p>Texto guardado: <strong>{{ session('texto') }}</strong></p>
@endif
<form action="/guardar" method="get">
    <input type="text" name="texto">
    <input type="submit" value="Enviar">
</form>
</body>
</html