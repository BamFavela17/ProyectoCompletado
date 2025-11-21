<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Resultado del Formulario</h1>

    <?php
        $nombre = session("nombre");
        $numero1 = session("numero1");
        $numero2 = session("numero2");
        $operacion = session("operacion");
        $resultado = session("resultado");

    if(isset($nombre) && isset($numero1) && isset($numero2))
        {
            echo "<p>Hola <strong>" .$nombre . "</strong>, Bienvenida!</p>";
            echo "<p>El resultado de la operacion <strong>" .$numero1 . " y " . $numero2 . "</strong> es :" .$resultado . "</strong></p>" ;
        } else {
            echo "<p>No se han proporcionado todos los datos necesarios</p>";
        }


    ?>
</body>
</html>