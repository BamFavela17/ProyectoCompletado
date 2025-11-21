<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Formulario de Bienvenida</h1>
    <form method="POST" action="/operacion/calcular">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Alely Sainz" required>
        <br/>
        <label for="numero1">Ingresa el Primer Numero</label>
        <input type="text" name="numero1" placeholder="5" required>
        <br/>
        <label for="numero2">Ingresa el Segundo Numero</label>
        <input type="text" name="numero2" placeholder="4" required>
        <br/>
        <label for="operacion">Seleccione la operacion: </label>
        <select name="operacion" required>
            <option value="sumar">Sumar</option>
            <option value="restar">Restar</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select>
        <br/>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>