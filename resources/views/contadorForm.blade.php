<!DOCTYPE html>
<html>
<body>
<h1>Formulario Contador</h1>
<?php
$count = session('count');
if($count) {
    echo "<p>contador: <strong>". $count . "</strong></p>";
} else {
    echo "<p>contador: 0 </p>";
}
    ?> 
<form action="/session/count/add" method="get">
    <input type="submit" name="añadir">
    </form>
<form action="/session/count/remove" method="get">
    <input type="submit" value="quitar">
</form>

</body>
</html